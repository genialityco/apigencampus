<?php

namespace App\Http\Controllers;

// models
use App\TemplateBingo;
use Illuminate\Http\Request;

/**
 * @group Millionaire
 *
 */

class TemplateBingosController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'format' => 'required|string',
            'image' => 'required|string',
            'index_to_validate' => 'required|array',
            'category' => 'required|string',
        ]);
        $data = $request->json()->all();
        $templateBingo = TemplateBingo::create($data);

        return response()->json($templateBingo, 201);

    }

    public function update(Request $request, TemplateBingo $templateBingo)
    {
        $data = $request->json()->all();
        $templateBingo->fill($data);
        $templateBingo->save();

        return response()->json($templateBingo, 200);
    }

    public function destroy(TemplateBingo $templateBingo)
    {
        $templateBingo->delete();

        return response()->json(null, 204);
    }

    public function getTemplatesByFormat(string $format)
    {
        $templateBingo = TemplateBingo::where('format', $format)->get();
        return response()->json($templateBingo, 200);
    }

}
