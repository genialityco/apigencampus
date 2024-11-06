<?php

use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
use Illuminate\Support\Facades\Route;

require (__DIR__ . '/attendize/attendize.php');


Route::get('testsendemail', 'TestingController@sendemail');


Route::get('test', 'EventController@index');
Route::post('testpush', 'SendContentController@sendPushNotification');

// Ver rutas que tienen documetación
Route::get('routes', 'RouteController@index');
Route::get('routes/excel', 'RouteController@excel')->name('routes.excel');

// Route::view('docs', 'apidoc.index');

// Route::get('/', function (Illuminate\Http\Request $request) {
//     Log::debug("redirect to " . $request->ip() . " to /routes");
//     return redirect('/routes');
// });

