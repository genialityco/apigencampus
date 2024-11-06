<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageUserResource;
use App\MessageUser;
use App\Event;
use Illuminate\Http\Request;
use App\evaLib\Services\FilterQuery;

/**
 * Verb          Path                              Action  Route Name
 *  GET           /messageUser                      index   users.index
 *  POST          /messageUser                      store   users.store
 *  GET           /messageUser/{messageUser}        show    users.show
 *  PUT|PATCH     /messageUser/{messageUser}        update  users.update
 *  DELETE        /messageUser/{messageUser}        destroy users.destroy
 */
class MessageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar = ["puerco" => "sucio", "verde" => "color"];

        MessageUser::unguard();
        $Topic = new MessageUser($ar);

        $Topic->save();
        return ["false" => "false"];
        return MessageUserResource::collection(MessageUser::paginate(50));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messageUser = MessageUser::create($request->json()->all());
        return new MessageUserResource($book);
    }

    public function create(Request $request)
    {
        $messageUser = MessageUser::create($request->json()->all());
        return new MessageUserResource($book);
    }
    public function edit(Request $request)
    {
        $messageUser = MessageUser::create($request->json()->all());
        return new MessageUserResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messageUser = MessageUser::findOrFail($id);
        return new MessageUserResource($messageUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageUser $messageUser)
    {
        $messageUser->update($request->json()->all());
        return new MessageUserResource($messageUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MessageUser $messageUser
     * @return json null http 204
     */
    public function destroy(MessageUser $messageUser)
    {
        $book->delete();
        return response()->json(null, 204);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function indexMessage(Request $request, $event_id, $message_id)
    {
       $event = Event::findOrfail($event_id);

       //páginacion pordefecto
       $pageSize = (int) $request->input('pageSize');
       $pageSize = ($pageSize) ? $pageSize : config('app.page_size');
       $messageUser = MessageUser::where('message_id' , $message_id)->orderBy('created_at','desc')->paginate($pageSize, ['id' , 'email', 'status']);
       return MessageUserResource::collection($messageUser);
    }
}
