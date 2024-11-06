<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Http\Resources\Json\JsonResource;
use Auth;


/**
 * @group Comment
 * 
 * 
 */
class CommentController extends Controller
{
    /**
     * _index_: list comments
     */
    public function index()
    {
        return JsonResource::collection(
            Comment::paginate(config('app.page_size'))
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
     * _store_: create new coment
     * @autenticathed
     * 
     * @bodyParam organization_id string
     * @bodyParam comment string
     * @bodyParam image string
     */
    public function store(Request $request)
    {   

        $data = $request->json()->all();
        $data['account_id'] = Auth::user()->_id;
        $result = new Comment($data);
        $result->save();

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        $response = new JsonResource($comment);
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $comment = Comment::find($id);
        $comment->fill($data);
        $comment->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        return  (string) $comment->delete();
    }

    /**
     * _indexByOrganization_: list comments
     * 
     * @urlParam organization required
     */
    public function indexByOrganization($organization_id)
    {
        $comment = Comment::where("organization_ids" , $organization_id)->get();
        return $comments;
    }
}
