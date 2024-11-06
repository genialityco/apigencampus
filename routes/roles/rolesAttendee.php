<?php

/*
|--------------------------------------------------------------------------
| API Roles Attendee
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for tha manage for roles to attendee. 
| into events.
*/
use Illuminate\Support\Facades\Route;

/****************
* RolEvent
****************/
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::get('events/{event}/rolesattendees', 'RolEventController@index');
        Route::post('events/{event}/rolesattendees', 'RolEventController@store')->middleware('permission:create');
        Route::get('events/{event}/rolesattendees/{rolevent}', 'RolEventController@show');              
        Route::put('events/{event}/rolesattendees/{rolevent}', 'RolEventController@update')->middleware('permission:update');
        Route::delete('events/{event}/rolesattendees/{rolevent}', 'RolEventController@destroy')->middleware('permission:destroy');
    }
);
// Duplicated but...
Route::get('events/{event}/rolesattendees', 'RolEventController@index');

/****************
* RolesPermissions
****************/
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::get('events/{event}/rolespermissions', 'RolesPermissionsEventController@index')->middleware('permission:read'); 
        Route::get('events/{event}/rolespermissionsbyrol/{rol}', 'RolesPermissionsEventController@indexByRol');
        Route::get('events/{event}/rolespermissions/{rolpermission}', 'RolesPermissionsEventController@show')->middleware('permission:read'); 
        Route::post('events/{event}/rolespermissions', 'RolesPermissionsEventController@store')->middleware('permission:create'); 
        Route::put('events/{event}/rolespermissions/{rolpermission}', 'RolesPermissionsEventController@update')->middleware('permission:update');        
        Route::delete('events/{event}/rolespermissions/{rolpermission}', 'RolesPermissionsEventController@update')->middleware('permission:destroy');                
    }
);

/****************
* Permissions
****************/
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::get('permissions', 'PermissionController@index');
    }
);

