<?php

namespace App\Http\Controllers;

use App\Module;
use App\Activities;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use Log;

class ModuleController extends Controller
{
    public function index(Request $request) {
        $query = Module::all();
        return EventResource::collection($query);
    }

    public function show(Request $request, $module_id)
    {
        $module = Module::find($module_id);
        if (!$module)
        {
            Log::debug("module " . $module_id . " does not exist");
            return response()->json(['error' => 'That module does not exist'], 404);
        }
        return response()->json($module);
    }

    public function destroy(Request $request, $module_id)
    {
        $module = Module::find($module_id);
        if (!$module)
        {
            Log::debug("module " . $module_id . " does not exist");
            return response()->json(['error' => 'That module does not exist'], 404);
        }
        $module->delete();
        Log::debug("destroyed module: " . $module_id);
        return response()->json(['success' => true], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_name' => 'required|string|max:255',
        ]);
        $data = $request->json()->all();
        if (!isset($data["order"])) { $data["order"] = 0; }

        $module = new Module;
        $module->module_name = $data["module_name"];
        $module->order = $data["order"];
        // TODO: check if activity_ids is in, and save
        if (array_key_exists('activity_ids', $data) && is_array($data['activity_ids']))
        {
            Log::debug("Add activity_ids: " . serialize($data['activity_ids']));
            $module->activity_ids =$data['activity_ids'];
        }

        if (array_key_exists('event_id', $data))
        {
            Log::debug("Add event_id: " . serialize($data['event_id']));
            $module->event_id =$data['event_id'];
        }

        $module->save();

        return $module;
    }

    // public function storeModulesForEvent(Request $request, $event_id)
    // {
    //     $validatedData = $request->validate([
    //         'module_name' => 'required|string|max:255',
    //         'event_id' => 'string',
    //     ]);
    //     $data = $request->json()->all();

    //     $module = new Module;
    //     $module->module_name = $data["module_name"];
    //     $module->event_id = $data["event_id"];
    //     // TODO: check if activity_ids is in, and save
    //     if (array_key_exists('activity_ids', $data) && is_array($data['activity_ids']))
    //     {
    //         Log::debug("Add activity_ids: " . serialize($data['activity_ids']));
    //         $module->activities()->sync($data['activity_ids']);
    //     }
    //     $module->save();
    //     $module->event()->sync($data["event_id"]); // Redundant? I dont be sure

    //     return $module;
    // }

    public function update(Request $request, $module_id)
    {
        $request->validate([
            'module_name' => 'required|string|max:255',
        ]);
        $data = $request->json()->all();

        $module = Module::findOrFail($module_id);
        $module->fill($data);
        $module->save();

        return response()->json($module);
    }

    public function updateActivityIds(Request $request, $module_id)
    {
        $request->validate([
            'activity_ids' => 'array',
            'activity_ids.*' => 'string',
        ]);
        $data = $request->json()->all();

        $activity_ids = $data['activity_ids'];

        $module = Module::findOrFail($module_id);
        $module->activities()->sync($activity_ids);
        Log::debug('add event ' . serialize($activity_ids) . ' ids to module ' . $module_id);

        return response()->json($module);
    }

    public function showAllActivities(Request $request, $module_id)
    {
        $module = Module::find($module_id);
        if (!$module)
        {
            Log::debug("module " . $module_id . " does not exist");
            return response()->json(['error' => 'That module does not exist'], 404);
        }
        return response()->json($module->activities);
    }

    public function showAllActivitiesWithoutModule(Request $request, $event_id)
    {
        $activities = Activities::where(function ($query) {
            $query->where('module_ids', null)->orWhere('module_ids', []);
        })->where('event_id', $event_id)->get();
        Log::debug("activities for event id: " . $event_id);
        return response()->json($activities);
    }

    public function showModulesForActivity(Request $request, $activity_id)
    {
        $activity = Activities::findOrFail($activity_id);
        return response()->json($activity);
    }

    public function showModulesForEvent(Request $request, $event_id)
    {
        $modules = Module::where('event_id', $event_id)->get();
        return response()->json($modules);
    }
}
