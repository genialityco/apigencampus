<?php

namespace App\Http\Controllers;

use App\Escarapela;
use App\Http\Resources\EscarapelaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EscarapelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 0;
        return EscarapelaResource::collection(
            Escarapela::paginate(config('app.page_size'))
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $fields_id =  $data['fields_id'];
        $escarapela = Escarapela::where('fields_id', $fields_id)->delete();

        // return $escarapela;
        if($escarapela == true){
            
            $result = new Escarapela($data);
            $result->save();
            return $result;
        }else{
            $result = new Escarapela($data);
            $result->save();
            return $result;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Escarapela  $escarapela
     * @return \Illuminate\Http\Response
     */
    public function show(String $event_id)
    {
        $escarapela = Escarapela::where('fields_id', $event_id)->first();
        if($escarapela){
            $response = new EscarapelaResource($escarapela);
            return $response;
        }else{
            return array();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escarapela  $escarapela
     * @return \Illuminate\Http\Response
     */
    public function edit(Escarapela $escarapela)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Escarapela  $escarapela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $event_id)
    {   
        $escarapela = Escarapela::where('fields_id', $event_id);
        $del = $escarapela->delete();

        if ($del == true) {
        $data = $request->json()->all();
        $result = new Escarapela($data);
        $result->save();
        return $result;
        } else{
            return 'Error';
        }
    }

    /**
     * Remove the specified escarapela from storage.
     *
     * @param  \App\String  $event_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $event_id)
    {
        $escarapela = Escarapela::where('fields_id', $event_id);
        $del = $escarapela->delete();

        if ($del == true) {
            return 'True';
        } else {
            return 'Error';
        }
    }
}
