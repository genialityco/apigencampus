<?php

namespace App\Http\Controllers;

use App\Attendize\Utils;
use App\Affiliate;
use App\Event;
use App\Models\EventStats;
use Auth;
use Cookie;
use Illuminate\Http\Request;
use Mail;
use Validator;
use App\Models\Ticket;
use DB;

class EventViewController extends Controller
{
    /**
     * Show the homepage for an event
     *
     * @param Request $request
     * @param $event_id
     * @param string $slug
     * @param bool $preview
     * @return mixed
     */
    public function showEventHome(Request $request, $event_id, $slug = '', $preview = false)
    {
        $date = new \DateTime();
        $now =  $date->format('Y-m-d H:i:s');
        $stage_act = 0;
 
        $event = Event::findOrFail($event_id);
        $stages = $event->event_stages;
        $codes_discounts = $event->codes_discount; 

        foreach ($stages as $key => $stage) { 
            $status = ($stage["start_sale_date"] > $now) ?  true : false;
            $stages[$key] += ['status' => $status];
        }

        $data = [
            'event'       => $event,
            'tickets'     => $event->tickets()->where('is_hidden', 0)->orderBy('stage', 'asc')->get(),
            'is_embedded' => 0,
            'stages' => $stages,
        ];
        
        /*
         * Don't record stats if we're previewing the event page from the backend or if we own the event.
         */
        if (!$preview && !Auth::check()) {
            $event_stats = new EventStats();
            $event_stats->updateViewCount($event_id);
        }

        /*
         * See if there is an affiliate referral in the URL
         */
        if ($affiliate_ref = $request->get('ref')) {
            $affiliate_ref = preg_replace("/\W|_/", '', $affiliate_ref);

            if ($affiliate_ref) {
                $affiliate = Affiliate::firstOrNew([
                    'name'       => $request->get('ref'),
                    'event_id'   => $event_id,
                    'account_id' => $event->account_id,
                ]);

                ++$affiliate->visits;

                $affiliate->save();

                Cookie::queue('affiliate_' . $event_id, $affiliate_ref, 60 * 24 * 60);
            }
        }

        return $data;
    }

    /**
     * Show preview of event homepage / used for backend previewing
     *
     * @param $event_id
     * @return mixed
     */
    public function showEventHomePreview($event_id)
    {
        return showEventHome($event_id, true);
    }

    /**
     * Sends a message to the organiser
     *
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function postContactOrganiser(Request $request, $event_id)
    {
        $rules = [
            'name'    => 'required',
            'email'   => ['required', 'email'],
            'message' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'   => 'error',
                'messages' => $validator->messages()->toArray(),
            ]);
        }

        $event = Event::findOrFail($event_id);

        $data = [
            'sender_name'     => $request->get('name'),
            'sender_email'    => $request->get('email'),
            'message_content' => strip_tags($request->get('message')),
            'event'           => $event,
        ];

        Mail::send('Emails.messageReceived', $data, function ($message) use ($event, $data) {
            $message->to($event->organiser->email, $event->organiser->name)
                ->from(config('attendize.outgoing_email_noreply'), $data['sender_name'])
                ->replyTo($data['sender_email'], $data['sender_name'])
                ->subject(trans("Email.message_regarding_event", ["event"=>$event->title]));
        });

        return response()->json([
            'status'  => 'success',
            'message' => trans("Controllers.message_successfully_sent"),
        ]);
    }

    public function showCalendarIcs(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);

        $icsContent = $event->getIcsForEvent();

        return response()->make($icsContent, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="event.ics'
        ]);
    }
}
