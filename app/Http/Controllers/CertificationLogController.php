<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\CertificationLog;
use App\Certification;
use App\Event;
use App\Account;
use Carbon\Carbon;
use Log;

class CertificationLogController extends Controller {
    public function index(Request $request) {
        Log::debug("wanna index all certification logs");
        $certification_logs = CertificationLog::all();
        return response()->json($certification_logs);
    }

    public function indexFromEvent(Request $request, $event_id) {
        Log::debug("wanna index all certification logs for event " . $event_id);
        $certification_logs = CertificationLog::where("event_id", $event_id)->get();
        return response()->json($certification_logs);
    }

    public function show(Request $request, $certification_log_id) {
        Log::debug("wanna show certification log ".$certification_log_id);
        $certification_log = CertificationLog::where("_id", $certification_log_id)->first();
        if ($certification_log) {
            return response()->json($certification_log);
        }
        return response()->json(["message" => "That certification does not exist"], 404);
    }

    public function destroy(Request $request, $certification_log_id) {
        Log::debug("wanna destroy certification log ".$certification_log_id);
        $certification_log = CertificationLog::where("_id", $certification_log_id)->first();

        if ($certification_log) {
            $certification_log->destroy($certification_log_id);
            return response()->json(["success" => true], 200);
        }

        return response()->json(["message" => "That certification does not exist"], 404);
    }

    public function store(Request $request) {
        Log::debug("wanna store certification log");
        $request->validate([
            "certification_id" => "string",
            "approved_from_date" => "date",
            "approved_until_date" => "date",
            "success" => "boolean",
        ]);
        $data = $request->json()->all();

        if (!isset($data["certification_id"])) {
            response()->json(["message" => "Certification ID is not defined"], 400);
        }

        $certification = Certification::where("_id", $data["certification_id"])->first();
        if (!$certification) {
            response()->json(["message" => "Certification does not exist"], 404);
        }

        $data["approved_from_date"] = Carbon::parse($data["approved_from_date"]);
        $data["approved_until_date"] = Carbon::parse($data["approved_until_date"]);

        $certification_log = new CertificationLog($data);
        Log::debug("certification log created: " . json_encode($certification_log));

        $certification_log->certification()->associate($certification);
        $certification_log->save();

        return response()->json($certification_log);
    }

    public function update(Request $request, $certification_log_id) {
        Log::debug("wanna update certification log ".$certification_log_id);
        $data = $request->json()->all();
        
        $certification_log = CertificationLog::where("_id", $certification_log_id)->first();

        if ($certification_log) {
            if (isset($data["success"])) { $certification_log["success"] = $data["success"]; }
            if (isset($data["approved_from_date"])) { $data["approved_from_date"] = Carbon::parse($data["approved_from_date"]); }
            if (isset($data["approved_until_date"])) { $data["approved_until_date"] = Carbon::parse($data["approved_until_date"]); }
            $certification_log->fill($data);
            $certification_log->save();
            return response()->json($certification_log);
        }
        return response()->json(["message" => "That certification log does not exist"], 404);
    }
}
