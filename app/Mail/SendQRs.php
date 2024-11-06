<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Organization;
use App\evaLib\Services\GoogleFiles;
use Barryvdh\DomPDF\Facade as PDF;
use QRCode;

class SendQRs extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $qrs;
    public $eventUser;
    public $attendees;
    public $event;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eventUser, $event, $attendees, $order)
    {
        $this->eventUser = $eventUser;
        $this->event = $event;
        $this->attendees = $attendees;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->event->name;
        $event = $this->event;
        $order = $this->order;

        $this->qrs = [];
        foreach ($this->attendees as $attendee) {
            ob_start();
            $qr = QRCode::text($attendee->_id)->setSize(6)->setMargin(2)->png();
            $page = ob_get_contents();
            ob_end_clean();
            $qr = base64_encode($page);
            array_push( $this->qrs, ['code' => $qr, 'name_ticket' => $attendee->properties['names']] );
        }

        $organization = !empty($this->event->organizer_id) ? Organization::find($this->event->organizer_id) : null;
        $from = !empty($organization) ? $organization->name : "Evius Event ";
        $emailOrganization = !empty($organization->email) ? $organization->email :config('mail.from.address');

        $mail = $this ->from($emailOrganization, $from);
        $mail->subject($subject);
        
        // Generate pdf
        foreach ($this->qrs as $qr) {
            $pdf = PDF::loadview('rsvp.pdfQR', compact('qr', 'event', 'organization', 'order'));
            $pdf->setPaper([0.0, 0.0, 300, 150], 'portrait');
            $mail->attachData($pdf->download(), $qr['name_ticket'].".pdf");
        }

        return $mail->markdown('rsvp.sendQR');
    }
}
