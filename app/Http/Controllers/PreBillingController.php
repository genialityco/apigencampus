<?php

namespace App\Http\Controllers;

use App\PreBilling;
use App\Payment;
use App\Plan;
use App\Account;
use App\User;
use Illuminate\Http\Request;

/**
 * @group PreBilling
 *
 */
class PreBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preBillings = PreBilling::all();
        return response()->json($preBillings);
    }

    /**
     * _store_: Create new PreBilling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        
        $data = $request->json()->all();
       
        $preBilling = new PreBilling($data);
        $preBilling->save();

        return response()->json($preBilling, 201);

    }


    /**
     * _show_: display information about a specific PreBilling.
     * 
     * @authenticated
     * @urlParam PreBilling required id of the PreBilling you want to consult. Example: 6298cb08f8d427d2570e8382
     * @response{
     *   "_id": "6298cb08f8d427d2570e8382",
	 *   "message": "Test",
	 *   "status": "ACTIVE",
	 *   "user_id": "628fdc698b89a10b9d464793",
	 *   "updated_at": "2022-06-02 14:39:27",
	 *   "created_at": "2022-06-02 14:36:56"
     * }
     */
    public function show($preBilling)
    {
        $preBilling = PreBilling::findOrFail($preBilling);

        return $preBilling;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreBilling  $PreBilling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $preBilling)
    {
        $data = $request->json()->all();
        $billing  = PreBilling::findOrFail($preBilling);
        $billing->fill($data);
        $billing->save();

        return response()->json($billing);
    }

    /**
     * _destroy_: delete PreBilling and related data.
     * @authenticated
     * @urlParam PreBilling required id of the PreBilling to be eliminated
     * 
     */
    public function destroy($preBilling)
    {
        $preBilling = PreBilling::findOrFail($preBilling);
        $preBilling->delete();

        return response()->json([], 204);
    }
}
