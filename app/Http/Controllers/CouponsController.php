<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return response()->json($coupons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'discount' => 'required|numeric',
            'category' => 'required|string'
        ]);

        $data = $request->json()->all();
        $coupon = new Coupon($data);
        $coupon->save();

        return response()->json($coupon, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show($coupon)
    {
        $coupon = Coupon::findOrFail($coupon);

        return $coupon;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function findByName($name)
    {
        $coupon = Coupon::where('name', $name)->where('isActive', true)->get();
        //dd(json_decode($coupon)==null);

        if (json_decode($coupon)==null) {
            return response()->json(['message'=>'Coupon not found']);
        }

        return $coupon;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $coupon)
    {
        $data = $request->json()->all();
        $coupon  = Coupon::findOrFail($coupon);
        $coupon->fill($data);
        $coupon->save();

        return response()->json($coupon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($coupon)
    {
        $coupon = Coupon::findOrFail($coupon);
        $coupon->delete();

        return response()->json([], 204);
    }
}
