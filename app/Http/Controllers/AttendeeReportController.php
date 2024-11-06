<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activities;
use App\Event;
use App\OrganizationUser;
use Google\Cloud\Firestore\FirestoreClient;

use Log;

class AttendeeReportController extends Controller
{
    public function getAllByEvent(Request $request, String $eventId) {
        $firestore = new FirestoreClient([
            'keyFilePath' => base_path('firebase-credentials.json')
        ]);

        $event = Event::findOrFail($eventId);
        $attendees = $event->attendees;

        $activities = Activities::where("event_id", $eventId);

        $publishedActivities = [];
        $nonPublishedActivityIds = [];
        foreach ($activities as $activity) {
            $ref = $firestore->collection('events')
                ->document($eventId)
                ->collection('activities')
                ->document($activity->_id);
            $snapshot = $ref->snapshot();
            if ($snapshot->exists()) {
                $data = $snapshot->data();

                // Check if the activity is published
                if (isset($data['isPublished']) && $data['isPublished']) {
                    array_push($publishedActivities, $data);
                } else {
                    array_push($nonPublishedActivityIds, $activity['_id']);
                }
                
            }
        }

        $eventUsersAndOrganizationUsers = [];
        foreach ($attendees as $attendee) {
            $organizationUser = OrganizationUser::where('account_id', $attendee['account_id'])->first();

            if (!$organizationUser) {
                Log::warning("I never see an user without organization user. User id: ".$attendee['account_id']);
                continue;
            }

            array_push($eventUsersAndOrganizationUsers, [
                "attendee" => $attendee,
                "member" => $organizationUser,
            ]);
        }

        return response()->json([
            "attendees" => $eventUsersAndOrganizationUsers,
            "count" => count($attendees)
        ]);
    }
}
