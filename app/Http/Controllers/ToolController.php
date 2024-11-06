<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;

class ToolController extends Controller
{
    public function index($event)
    {
	return Tool::where('event_id', $event)->latest()->paginate();
    }

    public function store(Request $request, $event)
    {
	$request->validate([
	    'name' => 'required|string',
	]);

	$data = $request->json()->all();
	$tool = new Tool($data);
	$tool->event_id = $event;
	$tool->save();

	return response()->json(compact('tool'), 201);
    }

    public function show($event, Tool $tool)
    {
	return compact('tool');
    }

    public function update(Request $request, $event, Tool $tool)
    {
	$request->validate([
	    'name' => 'required|string'
	]);

	$data = $request->json()->all();
	$tool->fill($data);
        $tool->save();

	return compact('tool');
    }

    public function destroy($event, Tool $tool)
    {
	$tool->delete();
	return response()->json([], 204);
    }

}
