<?php

namespace App\Http\Controllers;

use App\OrganizationUser;
use App\Position;
use App\Attendee;
use App\Account;
use App\Event;
use App\Rol;
use App\Organization;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
// use Log;
use Illuminate\Support\Facades\Log as Log;

/**
 * TODO: Add docstrings because I don't know the format for Laravel API standard, for now, right?
 */
class PositionController extends Controller
{
    public function clean(Request $request) {
        $events = Event::all();
        foreach ($events as $event) {
            if ($event->position_ids && count($event->position_ids) > 0) {
                Log::debug("analyze " . $event->name . "...");
                $new_position_ids = [];
                foreach ($event->position_ids as $position_id) {
                    $position = Position::find($position_id);
                    if ($position) {
                        array_push($new_position_ids, $position_id);
                    } else {
                        Log::debug("\tposition id " . $position_id . " does not exist");
                    }
                }
                Log::debug("optimize position ids from " . count($event->position_ids) . " to " . count($new_position_ids));
                $event->positions()->sync($new_position_ids);
            }
        }
    }

    public function index(Request $request) {
        // Some filters
        $organization_id = $request->query("organization_id");

        // Check if there are filters
        if ($organization_id) {
            $positions = Position::whereHas('organization', function($query) use($organization_id) {
                $query->where('_id', $organization_id);
            })->get();
        } else {
            // Get all
            $positions = Position::all();
        }

        return EventResource::collection($positions);
    }

    public function show(Request $request, $position_id)
    {
        $organization_id = $request->query("organization_id");

        $query = Position::where('_id', $position_id);

        if ($organization_id) {
            $query = $query->whereHas('organization', function($query) use ($organization_id) {
                $query->where('_id', $organization_id);
            });
        }

        $position = $query->first();

        if (!$position)
        {
            Log::debug("position ID " . $position_id . " does not exist. Extra: organization ID: " . $organization_id);
            return response()->json(['error' => 'That position does not exist'], 404);
        }
        return response()->json($position);
    }

    public function destroy(Request $request, $position_id)
    {
        $position = Position::find($position_id);
        if (!$position)
        {
            Log::debug("position " . $position_id . " does not exist");
            return response()->json(['error' => 'That position does not exist'], 404);
        }
        $position->events()->detach();

        $organization_users = [];
        if (isset($position->organization_id)) {
            $organization_users = OrganizationUser::where('organization_id', $position->organization_id)
                ->where('position_id', $position['_id'])
                ->get();
        }

        foreach ($organization_users as $org_user) {
            $org_user->position()->dissociate();
            $org_user->save();
        }

        $position->organization()->dissociate();
        $position->save();
        $position->delete();
        Log::debug("destroyed position: " . $position_id);
        return response()->json(['success' => true], 200);
    }

    /**
     * Create a new Position.
     * 
     * We need the body parameter of `position_name` to create the Position.
     */
    public function store(Request $request)
    {
        // We NEED the module name
        $request->validate([
            'position_name' => 'required|string|max:255',
        ]);
        $data = $request->json()->all();

        $position = new Position;
        $position->position_name = $data["position_name"];

        // IF event IDs are given, update
        if (isset($data["event_ids"])) {
            $event_ids = $data["event_ids"];
            Log::debug("set events from event IDs: " . json_encode($event_ids));
            $position->events()->sync($event_ids);
        }
        // If organization ID is given, update too
        if (isset($data["organization_id"])) {
            $organization_id = $data["organization_id"];
            Log::debug("set organization from organization ID: " . $organization_id);
            if (Organization::where('_id', $organization_id)->exists()) {
                $position->organization_id = $organization_id;
            } else {
                Log::warning("cannot find organization for " . $organization_id);
            }

            // Check if user IDs were passed to find their organization user and add it
            if (isset($data["user_ids"])) {
                $user_ids = $data["user_ids"];
                Log::debug("set organization users from user IDs: " . json_encode($user_ids));
                foreach ($user_ids as $user_id) {
                    $org_user = OrganizationUser::where('account_id' , $user_id)
                        ->where('organization_id', $organization_id)
                        ->first();
                    // $org_user->position()->associate($position);
                    $position->organization_users()->save($org_user);
                }
            }
        }
        // If organization user IDs are given, update too too
        if (isset($data["organization_user_ids"])) {
            $organization_user_ids = $data["organization_user_ids"];
            Log::debug("set organization users from organization user IDs: " . json_encode($organization_user_ids));
            foreach ($organization_user_ids as $organization_user_id) {
                $org_user = OrganizationUser::where('_id' , $organization_user_id)->first();
                $position->organization_users()->save($org_user);
                // $org_user->position()->associate($position);
            }
        }

        $position->save();

        return $position;
    }

    public function update(Request $request, $position_id)
    {
        $data = $request->json()->all();
        Log::debug("update position " . $position_id . " with " . json_encode($data));

        $position = Position::findOrFail($position_id);
        $position->fill($data);
        if ($data["event_ids"]) {
            $position->events()->sync($data["event_ids"]);
        }
        $position->save();

        return response()->json($position);
    }

    // Binding with organization

    /**
     * @deprecated use index() instead
     */
    public function indexForOrganization(Request $request, $organization_id) {
        $query = Position::whereHas('organization', function($query) use($organization_id) {
            $query->where('_id', $organization_id);
        })->get();
        return EventResource::collection($query);
    }

    /**
     * Find one position at organization.
     * 
     * If the position does not exist, return a 404 Not Found.
     * 
     * @deprecated use show() instead.
     */
    public function showForOrganization(Request $request, $position_id, $organization_id)
    {
        $position = Position::where('_id', $position_id)
            ->whereHas('organization', function($query) use ($organization_id) {
                $query->where('_id', $organization_id);
            })
            ->first();

        if (!$position)
        {
            Log::debug("position " . $position_id . " and organization " . $organization_id. " does not exist");
            return response()->json(['error' => 'That position does not exist'], 404);
        }
        return response()->json($position);
    }

    /**
     * Create new Position at organization.
     * 
     * We need the organization ID as URL parameter, and the `position_name`
     * as a body parameter.
     * 
     * Return the created position.
     * 
     * @deprecated use store() instead, and send more data
     */
    public function storeForOrganization(Request $request, $organization_id)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
        ]);
        $data = $request->json()->all();

        $position = new Position;
        $position->position_name = $data["position_name"];

        $organization = Organization::findOrFail($organization_id);
        $organization->positions()->save($position);

        Log::debug("attach position " . serialize($position) . " to organization " . $organization_id);
        return $position;
    }

    /**
     * List all the organization user at position at organization.
     */
    public function indexUsersForOrganizationAtPosition(Request $request, $position_id, $organization_id)
    {
        // Find the position by position ID
        $position = Position::where('_id', $position_id)
            ->whereHas('organization', function($query) use ($organization_id) {
                $query->where('_id', $organization_id);
            })
            ->first();

        if (!$position)
        {
            Log::debug("position " . $position_id . " and organization " . $organization_id. " does not exist");
            return response()->json(['error' => 'That position does not exist'], 404);
        }

        Log::debug('indexUsersForOrganizationAtPosition ' . json_encode($position, JSON_PRETTY_PRINT));

        // Now, find the organization users
        $organization_users = [];
        if (isset($position->organization_id)) {
            $organization_users = OrganizationUser::where('organization_id', $position->organization_id)
                ->where('position_id', $position['_id'])
                ->get();
        }

        return response()->json($organization_users);
    }

    /**
     * Add an organization user to position at organization.
     * 
     * It's needed the `user_id` body parameter.
     * 
     * Return the new updated position, but it will be changed anyway...
     */
    public function storeUsersForOrganizationAtPosition(Request $request, $position_id, $organization_id)
    {
        $request->validate([
            'user_id' => 'string',
        ]);
        $data = $request->json()->all();
        $user_id = $data['user_id'];

        // Get the position by the position ID
        $position = Position::where('_id', $position_id)
            ->whereHas('organization', function($query) use ($organization_id) {
                $query->where('_id', $organization_id);
            })
            ->first();

        if (!$position)
        {
            Log::debug("position " . $position_id . " and organization " . $organization_id. " does not exist");
            return response()->json(['error' => 'That position does not exist'], 404);
        }

        // Find the organization user for this organization and update the position
        $org_user = OrganizationUser::where('account_id' , $user_id)
            ->where('organization_id', $organization_id)
            ->first();
        if ($org_user) {
            Log::debug("org_user: " . json_encode($org_user));
            Log::debug("position " . json_encode($org_user->position));

            // Find last attendee and remove the user from those
            if ($org_user->position) {
                $events = $org_user->position->events;
                Log::debug("position " . $org_user->position["_id"] . " aka " . $org_user->position->position_name . " has " . count($events) . " events");

                foreach ($events as $event) {
                    $current_event_id = $event["_id"];
                    Log::debug("remove last attendee to event " . $current_event_id . " and user " . $user_id);
                    $attendee = Attendee::where('account_id', $user_id)
                        ->where('event_id', $current_event_id)
                        ->first();
                    if ($attendee) {
                        $this->deleteAttendeeIfPossible($current_event_id, $user_id);
                        Log::info("remove last attendee for user id " . $user_id);
                    }
                }
            }

            $org_user->position()->associate($position); // This is my new position btc
            $org_user->save();
            Log::debug("update organization user: " . $org_user);
        } else {
            return response()->json(['error' => 'This user does not exist. Are you passing the organization user ID instead of user ID?? NOOOOOOOOOOOO >:('], 404);
        }

        // Add the attendee
        $events = $position->events;//()->get();
        Log::debug("this position has " . count($events) . " events: " . json_encode($position->event_ids) . " :: " . json_encode($events));
        if (isset($position->event_ids)) {
            foreach ($position->event_ids as $event_id) {
                $current_event_id = $event_id;
                Log::debug("create attendee to event " . $current_event_id . " and user " . $user_id);

                // Try to remove last attendee
                $attendee = Attendee::where('account_id', $user_id)
                    ->where('event_id', $current_event_id)
                    ->first();
                if ($attendee) {
                    Log::info("avoid recreate attendee for user id " . $user_id);
                } else {
                    $this->deleteAttendeeIfPossible($current_event_id, $user_id); // Is this needed here?
                    $this->createAttendeeForThisUser($current_event_id, $user_id, true);
                    Log::info("Create attendee for user id " . $user_id);
                }
            }
        }

        Log::debug("add user " . $user_id . " to position: " . json_encode($position, JSON_PRETTY_PRINT));
        $position->save();

        return response()->json($position);
    }

    public function deleteAttendeeIfPossible($event_id, $user_id) {
        Log::info("will delete attendee for user ID: " . $user_id . ", event ID: " . $event_id);
        $attendee = Attendee::where('account_id', $user_id)
            ->where('event_id', $event_id)
            ->first();
        if ($attendee) {
            Log::debug("attendee exists");
            if ($attendee['rol_id'] != Rol::ID_ROL_ADMINISTRATOR) {
                Log::debug("attendee get be deleted");
                $attendee->delete();
            } else {
                Log::debug("attendee has rol ID of admin - don't delete anyway");
            }
        } else {
            Log::info("nothing to do");
        }
    }

    public function createAttendeeForThisUser($event_id, $user_id, $checked_in) {
        Log::info("will create attendee for user ID: " . $user_id . ", event ID: " . $event_id);
        $user = Account::where("_id", $user_id)->first();
        if (!$user) {
            Log::warning("User id " . $user_id . " does not exist");
            return;
        }

        $attendee = Attendee::where('account_id', $user_id)
            ->where('event_id', $event_id)
            ->first();
        if ($attendee) {
            Log::warning("can not create attendee duplicated");
            return;
        }

        Log::debug("user: " . json_encode($user));
        $payload = [
            "rol_id" => Rol::ID_ROL_ATTENDEE,
            "event_id" => $event_id,
            "account_id" => $user_id,
            "model_type" => "App\\Account", // Is this used yet? - this shit seems be the problem
            "state_id" => Attendee::STATE_DRAFT, // What is this? - ah, ok I got it
            "properties" => [
                "checked_in" => $checked_in,
                "email" => $user->email,
                "names" => $user->names,
                "code" => "+57", // Where can I check this code?
            ],
        ];

        Attendee::create($payload);
        Log::info("create attendee for user id " . $user_id);
    }

    /**
     * Update the events attached to the position at organization passed.
     * 
     * We need the body parameter of `event_ids` which should be an array of string.
     */
    public function updateEventsUsersForOrganizationAtPosition(Request $request, $position_id, $organization_id)
    {
        $request->validate([
            'event_ids' => 'array',
            'event_ids.*' => 'string',
        ]);
        $data = $request->json()->all();
        $event_ids = $data['event_ids'];

        // Get the position by position ID
        $position = Position::where('_id', $position_id)
            ->whereHas('organization', function($query) use ($organization_id) {
                $query->where('_id', $organization_id);
            })
            ->first();

        if (!$position)
        {
            Log::debug("position " . $position_id . " and organization " . $organization_id. " does not exist");
            return response()->json(['error' => 'That position does not exist'], 404);
        }

        // Remove removed events' attendee

        $existent_event_ids = [];
        foreach ($position->events as $event) {
            array_push($existent_event_ids, $event['_id']);
        }

        $event_ids_to_remove = array_diff($existent_event_ids, $event_ids);
        $event_ids_to_add = array_diff($event_ids, $existent_event_ids);

        $organization_users = [];
        if (isset($position->organization_id)) {
            $organization_users = OrganizationUser::where('organization_id', $position->organization_id)
                ->where('position_id', $position['_id'])
                ->get();
        }

        foreach ($organization_users as $organization_user) {
            $user_id = $organization_user->user['_id'];

            foreach ($event_ids_to_remove as $current_event_id) {
                $this->deleteAttendeeIfPossible($current_event_id, $user_id);
            }

            foreach ($event_ids_to_add as $current_event_id) {
                $this->createAttendeeForThisUser($current_event_id, $user_id, true);
            }
        }

        // Update the events attached
        $position->events()->sync($event_ids);
        Log::debug('add event ' . serialize($event_ids) . ' ids to position ' . $position_id);
        
        return response()->json(['success' => true], 200);
    }

    /**
     * Remove an organization user from the associated with the position at organization.
     * 
     * To do this we need the position ID, the organization ID, and the user ID.
     * 
     * NOTE: it isn't the organization user ID, it's the user ID.
     * 
     * Return the changed position.
     */
    public function deleteUserForOrganizationAtPosition(Request $request, $position_id, $organization_id, $user_id)
    {
        Log::debug("deleteUserForOrganizationAtPosition");
        // Get the position first
        $position = Position::where('_id', $position_id)
            ->whereHas('organization', function($query) use ($organization_id) {
                $query->where('_id', $organization_id);
            })
            ->first();

        if (!$position)
        {
            Log::debug("position " . $position_id . " and organization " . $organization_id. " does not exist");
            return response()->json(['error' => 'That position does not exist'], 404);
        }

        // We need all the event for this position to delete their attendees.
        // For each event, we find the attendee and delete it.
        if (isset($position->event_ids)) {
            foreach ($position->event_ids as $event_id) {
                $current_event_id = $event_id;
                $this->deleteAttendeeIfPossible($current_event_id, $user_id);
            }
        }

        // Remove the relationship between that organization user and this position
        Log::debug("delete organization user: " . $user_id);
        $org_user = OrganizationUser::where('account_id' , $user_id)
            ->where('organization_id', $organization_id)
            ->first();
        if ($org_user) {
            Log::debug("will delete organization user " . $org_user['_id']);
            $org_user->position()->dissociate();  // Not today
            $org_user->save();
        }

        return response()->json($position);
    }
}
