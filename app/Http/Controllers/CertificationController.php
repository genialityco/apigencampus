<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Certification;
use App\Position;
use App\Organization;
use App\Event;
use App\CertificationLog;
use App\Account;
use Carbon\Carbon;
use Log;

class CertificationController extends Controller {
    public function index(Request $request, $organization_id) {
        Log::debug("wanna index all certifications for organization " . $organization_id);
        $organization = Organization::find($organization_id);
        if (!$organization) {
            return response()->json(["message" => "organization ID does not exist: " . $organization_id], 404);
        }
        $events = Event::where("organizer_id", $organization_id)->get();
        $event_ids = collect($events)->pluck("_id")->toArray();
        Log::debug("found " . count($event_ids) . " event_ids");
        // All certification for these events at organization
        $certifications = Certification::whereIn("event_id", $event_ids)->get();
        Log::debug("got " . count($certifications) . " certifications");
        return response()->json($certifications);
    }

    public function indexCustom(Request $request) {
        $user_id = $request->query("user_id");
        $event_id = $request->query("event_id");

        if ((!isset($user_id) && !isset($event_id)) || (!$user_id && !$event_id)) {
            Log::debug("missing user_id and event_id");
            return response()->json(["message" => "missing user_id or event_id"], 400);
        }

        if (isset($user_id) && $user_id && isset($event_id) && $event_id) {
            Log::debug("wanna show certification by user ID " . $user_id . " and event ID " . $event_id);
            $certification = Certification::where("user_id", $user_id)
                ->where("event_id", $event_id)
                ->first();
            
            if ($certification) {
                return response()->json($certification);
            }
            Log::debug("this certification does not exist");
            return response()->json(["message" => "That certification does not exist"], 404);
        }
        
        if (isset($user_id) && $user_id) {
            Log::debug("wanna show certifications by user ID " . $user_id);
            $certifications = Certification::where("user_id", $user_id)->get();
        }  else if (isset($event_id) && $event_id) {
            Log::debug("wanna show certifications by event ID " . $event_id);
            $certifications = Certification::where("event_id", $event_id)->get();
        }

        Log::debug("get " . count($certifications) . " certifications");
        return response()->json($certifications);
    }

    public function indexByPosition(Request $request, $position_id) {
        $user_id = $request->query("user_id");

        // Get the position
        $position = Position::find($position_id);
        if (!$position) {
            return response()->json(["message" => "position not found"], 404);
        }

        // Get all the event IDs for this position
        $event_ids = collect($position->events)->pluck("_id")->toArray();
        Log::debug("found " . count($event_ids) . " event_ids");
        $collection = Certification::whereIn("event_id", $event_ids);

        // If the user_id is defined, then filter by user_id too
        if (isset($user_id)) {
            $collection = $collection->where("user_id", $user_id);
        }

        // Get the certifications and returns
        $certifications = $collection->get();
        return response()->json($certifications);
    }

    public function show(Request $request, $certification_id) {
        Log::debug("wanna show certification ".$certification_id);
        $certification = Certification::where("_id", $certification_id)->first();
        if ($certification) {
            return response()->json($certification);
        }
        return response()->json(["message" => "That certification does not exist"], 404);
    }

    public function destroy(Request $request, $certification_id) {
        Log::debug("wanna destroy certification ".$certification_id);
        $certification = Certification::where("_id", $certification_id)->first();

        if ($certification) {
            foreach ($certification->certificationLogs as $certificationLog) {
                $certificationLog->delete();
            }
    
            $certification->destroy($certification_id);
    
            return response()->json(["success" => true], 200);
        }

        return response()->json(["message" => "That certification does not exist"], 404);
    }

    public function store(Request $request) {
        // Validate the data
        Log::debug("wanna store certification");
        $request->validate([
            "user_id" => "string",
            "event_id" => "string",
            "approved_from_date" => "date",
            "approved_until_date" => "date",
        ]);
        $data = $request->json()->all();
        // Parse the date
        $data["approved_from_date"] = Carbon::parse($data["approved_from_date"]);
        $data["approved_until_date"] = Carbon::parse($data["approved_until_date"]);
        // Some data are optional, eh!
        if (!isset($data["description"])) { $data["description"] = ""; }
        if (!isset($data["entity"])) { $data["entity"] = ""; }
        if (!isset($data["success"])) { $data["success"] = false; }
        if (!isset($data["hours"])) { $data["hours"] = 1; }

        // Check if the user and event exist
        if (!isset($data["user_id"]) || !Account::where("_id", $data["user_id"])->exists()) {
            return response()->json(["message" => "User does not exist"], 404);
        }
        if (!isset($data["event_id"]) || !Event::where("_id", $data["event_id"])->exists()) {
            return response()->json(["message" => "Event does not exist"], 404);
        }

        $event = Event::where("_id", $data["event_id"])->first();
        if (!isset($data["hours"])) {
            Log::debug("certification hours not defined");
            $default_certification_hours = 0;
            if (isset($event->default_certification_hours)) {
                $default_certification_hours = $event->default_certification_hours;
            }
            Log::debug("certification hours defined to: " . $default_certification_hours);
            $data["hours"] = $default_certification_hours;
        }

        $certification = Certification::where("user_id", $data["user_id"])
            ->where("event_id", $data["event_id"])
            ->first();
        
        if ($certification) {
            Log::info("a certification exists already");

            // Update the success state and the dates
            $certification["success"] = $data["success"];
            $certification["description"] = $data["description"];
            $certification["hours"] = $data["hours"];
            $certification["entity"] = $data["entity"];
            $certification["approved_from_date"] = $data["approved_from_date"];
            $certification["approved_until_date"] = $data["approved_until_date"];
            if (isset($data["file_url"])) {
                $certification["file_url"] = $data["file_url"];
            } else {
                $certification["file_url"] = null;
            }
            if (isset($data["firestorage_path"])) {
                $certification["firestorage_path"] = $data["firestorage_path"];
            } else {
                $certification["firestorage_path"] = null;
            }
            $certification->save();

            // Create the first certification log
            $this->addCertificationLogForCertification($certification, $data["success"]);

            $certification = $certification->fresh();
        } else {
            Log::debug("store new certification: " . json_encode($data));
            $certification = new Certification($data);
            Log::debug("new certification: " . json_encode($certification));

            $user = Account::where("_id", $data["user_id"])->first();
            $certification->user()->associate($user);
            $certification->save();

            // Create the first certification log
            $this->addCertificationLogForCertification($certification, $data["success"]);

            $certification = $certification->fresh();
        }
        return response()->json($certification);
    }

    public function addLog(Request $request) {
        $request->validate([
            "success" => "boolean",
        ]);
        // Get some IDs to know what is this certification
        // We need:
        // - user_id & event_id
        // - certification_id
        $certification_id = $request->query("certification_id");
        $user_id = $request->query("user_id");
        $event_id = $request->query("event_id");

        // Search the certification
        $certification = null;
        if ($certification_id) {
            // Create the first certification logs
            $certification = Certification::find($certification_id);
            if (!$certification) {
                return response()->json(["message" => "Certificate ID " . $certification . " not found"], 404);
            }
        } else if ($user_id && $event_id) {
            $certification = Certification::where("user_id", $user_id)
                ->where("event_id", $event_id)
                ->first();
            if (!$certification) {
                return response()->json([
                    "message" => "Certificate for user ID " . $user_id . " and event ID " . $event_id . " not found"],
                    404,
                );
            }
        } else {
            return response()->json(["message" => "Parameters missing: user_id & event_id, or certification_id"], 400);
        }

        $data = $request->json()->all();
        $this->addCertificationLogForCertification($certification, $data["success"]);

        return response()->json($certification);
    }

    public function addCertificationLogForCertification($certification, $success) {
        Log::debug("add new certification log to " . json_encode($certification));
        $certification_log = new CertificationLog([
            "certification_id" => $certification["_id"],
            "approved_from_date" => $certification["approved_from_date"],
            "approved_until_date" => $certification["approved_until_date"],
            "file_url" => $certification["file_url"],
            "firestorage_path" => $certification["firestorage_path"],
            "success" => $success,
        ]);
        $certification_log->save();
    }

    public function update(Request $request, $certification_id) {
        Log::debug("wanna update certification ".$certification_id);
        $data = $request->json()->all();
        
        $certification = Certification::where("_id", $certification_id)->first();

        if (!$certification) {
            return response()->json(["message" => "That certification does not exist"], 404);
        }

        if (isset($data["approved_from_date"])) {
            $data["approved_from_date"] = Carbon::parse($data["approved_from_date"]);
        }
        if (isset($data["approved_until_date"])) {
            $data["approved_until_date"] = Carbon::parse($data["approved_until_date"]);
        }

        $certification->fill($data);
        
        $certification->save();
        
        return response()->json($certification);
    }
}
