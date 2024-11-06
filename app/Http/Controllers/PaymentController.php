<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentResource;

/**
 * @group Payment
 *
 */
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Payments = Payment::all();
        return response()->json($Payments);
    }

    /**
     * _store_: Create new Payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @bodyParam message string required message to Payment Example: Speakers limit reached
     * @bodyParam status string required status of Payment Example: ACTIVE || INACTIVE
     * @bodyParam user_id string required user related to Payment Example: 628fdc698b89a10b9d464793
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string'
        ]);

        $data = $request->json()->all();
        $payment_method = isset($data['billing']['payment_method']) ? $data['billing']['payment_method'] : null;
        $payment_method = (object) ['user_id' => $data['user_id'], 'properties'=> $data['billing']['payment_method']];
        //dd("payment Controller", $payment_method);
        if ($payment_method) {
            $Payment = new Payment((array) $payment_method);
            $Payment->save();
            return response()->json($Payment, 201);
        }
        return response()->json(['message'=> 'Payment method not found'], 404);

    }

    public function createByBilling($data, $user_id)
    {
        //dd("payment Controller", $data);
        if ($data) {
            $data['user_id'] = $user_id;
            $Payment = new Payment($data);
            $Payment->save();
            return response()->json($Payment, 201);
        }
        return response()->json(['message'=> 'Payment method not found'], 404);

    }
    /**
     * PaymentbyUser_: search of Payments by user.
     * 
     * @urlParam user required  user_id
     *
     */
    public function PaymentbyUser(string $user_id)
    {
        return PaymentResource::collection(
            Payment::where('user_id', $user_id)
                ->where('status', 'AVAILABLE')
                ->latest()
                ->paginate(config('app.page_size'))
        );
    }

    /**
     * _show_: display information about a specific Payment.
     * 
     * @authenticated
     * @urlParam Payment required id of the Payment you want to consult. Example: 6298cb08f8d427d2570e8382
     * @response{
     *   "_id": "6298cb08f8d427d2570e8382",
	 *   "message": "Test",
	 *   "status": "ACTIVE",
	 *   "user_id": "628fdc698b89a10b9d464793",
	 *   "updated_at": "2022-06-02 14:39:27",
	 *   "created_at": "2022-06-02 14:36:56"
     * }
     */
    public function show($Payment)
    {
        $Payment = Payment::findOrFail($Payment);

        return $Payment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $Payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Payment)
    {
        $data = $request->json()->all();
        $Payment  = Payment::findOrFail($Payment);
        $Payment->fill($data);
        $Payment->save();

        return response()->json($Payment);
    }

    /**
     * _destroy_: delete Payment and related data.
     * @authenticated
     * @urlParam Payment required id of the Payment to be eliminated
     * 
     */
    public function destroy($Payment)
    {
        $Payment = Payment::findOrFail($Payment);
        $Payment->delete();

        return response()->json([], 204);
    }
}
