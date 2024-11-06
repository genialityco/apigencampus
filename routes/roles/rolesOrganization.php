<?php

/****************
* Rol
****************/
use Illuminate\Support\Facades\Route;

// Route::group(
//     ['middleware' => 'auth:token'], function () {
        Route::get('organizations/{organization}/roles', 'RolOrganizationController@index');
        Route::post('organizations/{organization}/roles', 'RolOrganizationController@store')->middleware('permission:create');
        Route::get('organizations/{organization}/roles/{rol}', 'RolOrganizationController@show');              
        Route::put('organizations/{organization}/roles/{rol}', 'RolOrganizationController@update')->middleware('permission:update');
        Route::delete('organizations/{organization}/roles/{rol}', 'RolOrganizationController@destroy')->middleware('permission:destroy');
//     }
Route::post('organizations/{organization}/roles', 'RolOrganizationController@store');
Route::put('organizations/{organization}/roles/{rol}', 'RolOrganizationController@update');
// );