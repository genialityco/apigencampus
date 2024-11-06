<?php

namespace App\Http\Controllers;

use App\Attendee;
use App\Event;
use App\SharePhoto;
use Illuminate\Http\Request;

/**
 * @group SharePhoto
 *
 */

class SharePhotoController extends Controller
{

    /**
     * _index_: It returns all the share_photos in the database
     * It returns all the share photos in the database
     * 
     * @return All the share_photos in the database.
     */
    public function index()
    {
        $share_photos = SharePhoto::all();
        return response()->json($share_photos);
    }

    /**
     * _store_: It takes a request, validates it, and then saves it to the database
     * It takes a request, validates it, and then saves it to the database
     * 
     * 
     * @bodyParam title string required The title of the share_photo.
     * @bodyParam event_id int required The id of the event to add the share_photo to.
     * 
     * @return A JSON object with the share_photo data.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'event_id' => 'required|string',
        ]);

        $event = Event::where('_id', $request->event_id)->first();

        if(isset($event->dynamics)){
            $dynamics = $event->dynamics;
            $dynamics["share_photo"] = true;
        }else{
            $dynamics["share_photo"] = true;
        }
        $event->dynamics = $dynamics;
        $event->save();

        $data = $request->json()->all();
        $share_photo = new SharePhoto($data);
        $share_photo->save();

        return response()->json($share_photo, 201);
    }

    /**
     * _sharePhotoByEvent_: It takes an event_id and returns all the share_photos associated with that event
     * It returns the share photo of the event.
     * 
     * @urlParam event_id string required The id of the event to get the share photo of.
     */
    public function SharePhotobyEvent(string $event_id)
    {
        $share_photo = SharePhoto::where('event_id', $event_id)->first();
        return $share_photo;
    }

    /**
     * _show_: It takes a share_photo_id and returns the share_photo associated with that id
     * It finds the share_photo by id and returns it.
     * 
     * @urlParam id string required The id of the share_photo to get.
     *
     * 
     * @return The share_photo object
     */
    public function show($share_photo)
    {
        $share_photo = SharePhoto::findOrFail($share_photo);

        return $share_photo;
    }

    /**
     * _update_: It takes a request, validates it, and then updates the share_photo in the database
     * It updates the share_photo with the data from the request.
     * 
     * @urlParam id string required The id of the share_photo to update.
     * 
     * @bodyParam title string required The title of the share_photo.
     * @bodyParam event_id int required The id of the event to add the share_photo to.
     * @bodyParam tematic string required The tematic of the share_photo.
     * @bodyParam published boolean required The published status of the share_photo.
     * @bodyParam active boolean required The active status of the share_photo.
     * @bodyParam points_per_like int required The points per like of the share_photo.
     * @bodyParam posts array required The posts of the share_photo.
     * 
     * @return The updated share_photo object.
     */
    public function update(Request $request, $share_photo)
    {
        $data = $request->json()->all();
        $share_photo = SharePhoto::findOrFail($share_photo);
        $share_photo->update($data);

        return response()->json($share_photo, 200);
    }

    /**
     * _addOnePost_: It takes a request, validates it, and then adds a post to the share_photo in the database
     * It adds a post to a share photo
     * 
     * @urlParam id string required The id of the share_photo to add the post to.
     * 
     * @bodyParam event_user_id string required The id of the event user.
     * @bodyParam image string required The image of the post.
     * @bodyParam thumb string required The thumb of the post.
     * @bodyParam title string required The title of the post.
     * 
     * @return The response is a json with the share_photo object
     */
    public function addOnePost(Request $request, SharePhoto $share_photo)
    {
        $request->validate([
            'event_user_id' => 'required|string',
            'image' => 'required|string',
            'thumb' => 'required|string',
            'title' => 'required|string',
        ]);

        $data = $request->json()->all();
        $user_exist = Attendee::where('event_id', $share_photo->event_id)
            ->where('_id', $data['event_user_id'])
            ->first();

        if (!isset($user_exist)) {
            return response()->json(['error' => 'User not found'], 404);
        }

        //validacion de que el usuario no haya compartido antes
        if(isset($share_photo->posts)){
            foreach($share_photo->posts as $post){
                if($post['event_user_id'] == $data['event_user_id']){
                    return response()->json(['error' => 'User already posted'], 404);
                }
            }
        }

        $posts = isset($share_photo->posts) ? $share_photo->posts : [];

        $data['id'] = uniqid('');
        $data['user_name'] = $user_exist->properties['names'];
        $data['picture'] = $user_exist->user->picture ? $user_exist->user->picture : null;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['likes'] = [];

        array_push($posts, $data);
        $share_photo->posts = $posts;
        $share_photo->save();

        return response()->json($share_photo, 200);
    }

    /**
     * _removePost_: It takes a request, validates it, and then removes a post from the share_photo in the database
     * It removes a post from a share photo
     * 
     * @urlParam id string required The id of the share_photo to remove the post from.
     * @urlParam post_id string required The id of the post to remove.
     * 
     * @return A JSON object of the updated SharePhoto object.
     */
    public function removePost(SharePhoto $share_photo, $post_id)
    {
        $posts = isset($share_photo->posts) ? $share_photo->posts : [];
        $new_posts = [];
        foreach ($posts as $post) {
            if ($post['id'] != $post_id) {
                array_push($new_posts, $post);
            }
        }
        $share_photo->posts = $new_posts;
        $share_photo->save();

        return response()->json($share_photo, 200);
    }

    /**
     * _addOneLike_: It takes a request, validates it, and then adds a like to the share_photo in the database
     * It adds a like to a post in a share photo
     * 
     * @urlParam id string required The id of the share_photo to add the like to.
     * @urlParam post_id string required The id of the post to add the like to.
     * 
     * @bodyParam event_user_id string required The id of the event user.
     * 
     * @return The updated share_photo object
     */
    public function addOneLike(Request $request, SharePhoto $share_photo, $post_id)
    {
        $request->validate([
            'event_user_id' => 'required|string',
        ]);

        $data = $request->json()->all();

        $data['created_at'] = date('Y-m-d H:i:s');
        $postsCopy = [];

        foreach ($share_photo->posts as $post) {
            if ($post['id'] == $post_id) {
                $likes = isset($post['likes']) ? $post['likes'] : [];
                //Validacion de que el usuario no haya dado like antes al mismo post
                foreach($likes as $like){
                    if($like['event_user_id'] == $data['event_user_id']){
                        return response()->json(['error' => 'User already liked'], 404);
                    }
                }
                array_push($likes, $data);
                $post['likes'] = $likes;
                array_push($postsCopy, $post);
            } else {
                array_push($postsCopy, $post);
            }
        }
        $share_photo->posts = $postsCopy;
        $share_photo->save();
        return response()->json($share_photo, 200);
    }

    /**
     * _unlikePost_: It takes a request, validates it, and then removes a like from the share_photo in the database
     * It takes a post id and an event user id, finds the post with the given id, removes the like with
     * the given event user id, and saves the updated post
     * 
     * @urlParam id string required The id of the share_photo to remove the like from.
     * @urlParam post_id string required The id of the post to remove the like from.
     * 
     * @bodyParam event_user_id string required The id of the event user.
     * 
     * @return The updated share_photo object.
     */
    public function unlike(Request $request, SharePhoto $share_photo, $post_id)
    {
        $request->validate([
            'event_user_id' => 'required|string',
        ]);

        $postsCopy = [];
        $likesCopy = [];

        foreach ($share_photo->posts as $post) {
            if ($post['id'] == $post_id) {
                foreach ($post['likes'] as $like) {
                    if ($like['event_user_id'] != $request->event_user_id) {
                        array_push($likesCopy, $like);
                    }
                }
                $post['likes'] = $likesCopy;
                array_push($postsCopy, $post);
            } else {
                array_push($postsCopy, $post);
            }
        }
        $share_photo->posts = $postsCopy;
        $share_photo->save();
        return response()->json($share_photo, 200);
    }

    /**
     * _destroy_: It takes a request, validates it, and then removes a share_photo from the database
     * It deletes the share photo from the database.
     * 
     * @urlParam id string required The id of the share_photo to delete.
     * 
     * @return 204
     */
    public function destroy($share_photo)
    {

        $share_photo = SharePhoto::findOrFail($share_photo);
        $event = Event::where('_id', $share_photo->event_id)->first();
        if(isset($event->dynamics)){
            $dynamics = $event->dynamics;
            $dynamics["share_photo"] = false;
        }else{
            $dynamics["share_photo"] = false;
        }
        $event->dynamics = $dynamics;
        $event->save();
        $share_photo->delete();

        return response()->json([], 204);
    }
}
