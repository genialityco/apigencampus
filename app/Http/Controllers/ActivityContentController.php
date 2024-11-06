<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activities;
use App\ActivityContent;
use App\Event;
use Log;

class ActivityContentController extends Controller
{
    //
    public function update(Request $request, String $activity_id) {
        $request->validate([
            "type" => "string",
            "reference" => "string",
        ]);

        $data = $request->json()->all();

        $activity = Activities::findOrFail($activity_id);
        $content = $activity->content;

        if ($content) {
            Log::debug('Update activity content: '.json_encode($data));
            $content->update($data);
        } else {
            Log::debug('Create activity content: '.json_encode($data));
            $activity->content()->create($data);
        }

        Log::debug('updated: '.json_encode($content));

        return $activity->content;
    }

    public function destroy(Request $request, String $activity_id) {
        $content = ActivityContent::where('activity_id', $activity_id)->first();

        if (!$content) {
            return response()->json(["error" => "the activity $activity_id has no content"], 404);
        }
        
        Log::debug("will delete the activity content of " . $activity_id);
        $content->delete();
    }
}
