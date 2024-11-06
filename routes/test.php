<?php
/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
| This is where you can register API routes to do test in the api.
| 
*/
use Illuminate\Support\Facades\Route;

/***************
 * TEST
 ****************/
Route::get('test/serialization', 'TestingController@serialization');
Route::get('test/queue', 'TestingController@testQueue');
Route::get('test/auth', 'TestingController@auth');
Route::get('test/Gateway', 'TestingController@Gateway');
Route::get('test/request/{refresh_token}', 'TestingController@request');
Route::get('test/users', 'TestingController@users');
Route::get('test/awsnotification', 'TestingController@awsnotification');
Route::get('test/permissions', 'TestingController@permissions');
Route::get('test/orderSave/{order_id}', 'TestingController@orderSave');
Route::get('test/ticket/{ticket_id}/order/{order_id}', 'ApiOrdersController@deleteAttendee');


