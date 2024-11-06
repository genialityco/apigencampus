<?php

namespace App\Http\Controllers;

use App\Addon;
use Illuminate\Http\Request;
use App\Http\Resources\AddonResource;

/**
 * @group Addon
 *
 */
class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Addons = Addon::all();
        return response()->json($Addons);
    }

    /**
     * _store_: Create new Addon.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @bodyParam message string required message to Addon Example: Speakers limit reached
     * @bodyParam status string required status of Addon Example: ACTIVE || INACTIVE
     * @bodyParam user_id string required user related to Addon Example: 628fdc698b89a10b9d464793
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string'
        ]);

        $data = $request->json()->all();
        $addon = new Addon($data);
        $addon->save();

        return response()->json($addon, 201);

    }

    public function createByBilling($data, $user_id, $billing_id, $subscription)
    {
        if ($data) {
            $data['user_id'] = $user_id;
            $data['billing_id'] = $billing_id;
            $start_date = date('d-m-Y');
            $data['start_date'] = $start_date;
            if ($subscription == "MONTHLY") {
                $end_date = date('d-m-Y', strtotime($start_date . "+ 30 days"));
            }else if ($subscription == "YEARLY"){
                $end_date = date('d-m-Y', strtotime($start_date . "+ 1 year"));
            }
            $data['end_date'] = $end_date;
            $data['is_active'] = false;
            $Addon = new Addon($data);
            $Addon->save();
            return response()->json($Addon, 201);
        }
        return response()->json(['message'=> 'Addon not found'], 404);

    }
    /**
     * AddonbyUser_: search of Addons by user.
     * 
     * @urlParam user required  user_id
     *
     */
    public function AddonbyUser(string $user_id)
    {
        return AddonResource::collection(
            Addon::where('user_id', $user_id)
                ->latest()
                ->paginate(config('app.page_size'))
        );
    }

    /**
     * _show_: display information about a specific Addon.
     * 
     * @authenticated
     * @urlParam Addon required id of the Addon you want to consult. Example: 6298cb08f8d427d2570e8382
     * @response{
     *   "_id": "6298cb08f8d427d2570e8382",
	 *   "message": "Test",
	 *   "status": "ACTIVE",
	 *   "user_id": "628fdc698b89a10b9d464793",
	 *   "updated_at": "2022-06-02 14:39:27",
	 *   "created_at": "2022-06-02 14:36:56"
     * }
     */
    public function show($Addon)
    {
        $Addon = Addon::findOrFail($Addon);

        return $Addon;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Addon  $Addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Addon)
    {
        $data = $request->json()->all();
        $Addon  = Addon::findOrFail($Addon);
        $Addon->fill($data);
        $Addon->save();

        return response()->json($Addon);
    }

    /**
     * _destroy_: delete Addon and related data.
     * @authenticated
     * @urlParam Addon required id of the Addon to be eliminated
     * 
     */
    public function destroy($Addon)
    {
        $Addon = Addon::findOrFail($Addon);
        $Addon->delete();

        return response()->json([], 204);
    }
}
