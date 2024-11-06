<?php
use Illuminate\Support\Facades\Route;

Route::get   ('events/{event_id}/eventusers',      'EventUserController@indexar');
Route::get   ('events/{event_id}/eventusers/{id}', 'EventUserController@mostrar');

/****************$request->get('per_page', 25)
 * SPACES
 ****************/
Route::get   ('events/{event_id}/spaces', 'SpaceController@index');
Route::post  ('events/{event_id}/spaces', 'SpaceController@store');
Route::get   ('events/{event_id}/spaces/{id}', 'SpaceController@show');
Route::put   ('events/{event_id}/spaces/{id}', 'SpaceController@update');
Route::delete('events/{event_id}/spaces/{id}', 'SpaceController@destroy');

Route::post   ('events/{event_id}/activity/{acitivy_id}/capacity', 'InscriptionController@capacity');
Route::post  ('events/{event_id}/activity/', 'SpaceController@store');
Route::get   ('events/{event_id}/activity//{id}', 'SpaceController@show');
Route::put   ('events/{event_id}/activity//{id}', 'SpaceController@update');
Route::delete('events/{event_id}/activity//{id}', 'SpaceController@destroy');


/****************
 * QUANTITY
 ****************/
Route::get   ('events/{event_id}/quantity',      'QuantityController@index');
Route::post  ('events/{event_id}/quantity',      'QuantityController@store');
Route::get   ('events/{event_id}/quantity/{id}', 'QuantityController@show');
Route::put   ('events/{event_id}/quantity/{id}', 'QuantityController@update');
Route::delete('events/{event_id}/quantity/{id}', 'QuantityController@destroy');


/****************
 * ACTIVITY USERS
 ****************/
Route::get   ('events/{event_id}/activityusers',      'ActivityUsersController@index');
Route::post  ('events/{event_id}/activityusers',      'ActivityUsersController@store');
Route::get   ('events/{event_id}/activityusers/{id}', 'ActivityUsersController@show');
Route::put   ('events/{event_id}/activityusers/{id}', 'ActivityUsersController@update');
Route::delete('events/{event_id}/activityusers/{id}', 'ActivityUsersController@destroy');

/***************
 * HOST
 * 
 * rutas para guardar la agenda de los eventos
 ****************/

Route::get   ('events/{event_id}/host',      'HostController@index');
Route::post  ('events/{event_id}/host',      'HostController@store');
Route::get   ('events/{event_id}/host/{id}', 'HostController@show');
Route::put   ('events/{event_id}/host/{id}', 'HostController@update');
Route::delete('events/{event_id}/host/{id}', 'HostController@destroy');


/***************
 * USER PROPERTIES
 ****************/
Route::get   ('events/{event_id}/userproperties',      'UserPropertiesController@index');
Route::post  ('events/{event_id}/userproperties',      'UserPropertiesController@store');
Route::get   ('events/{event_id}/userproperties/{id}', 'UserPropertiesController@show');
Route::put   ('events/{event_id}/userproperties/{id}', 'UserPropertiesController@update');
Route::delete('events/{event_id}/userproperties/{id}', 'UserPropertiesController@destroy');


/***************
 * ACTIVITIES
 ****************/
Route::get   ('events/{event_id}/activities',      'ActivitiesController@index');
Route::post  ('events/{event_id}/activities',      'ActivitiesController@store');
Route::get   ('events/{event_id}/activities/{id}', 'ActivitiesController@show');
Route::put   ('events/{event_id}/activities/{id}', 'ActivitiesController@update');
Route::delete('events/{event_id}/activities/{id}', 'ActivitiesController@destroy');


/***************
 * TYPE
 ****************/
Route::get   ('events/{event_id}/type',      'TypeController@index');
Route::post  ('events/{event_id}/type',      'TypeController@store');
Route::get   ('events/{event_id}/type/{id}', 'TypeController@show');
Route::put   ('events/{event_id}/type/{id}', 'TypeController@update');
Route::delete('events/{event_id}/type/{id}', 'TypeController@destroy');


/***************
 * ACTIVITYCATEGORIES (las categorias para las actividades de la agenda)
 ****************/

Route::get   ('events/{event_id}/categoryactivities',      'ActivityCategoriesController@index');
Route::post  ('events/{event_id}/categoryactivities',      'ActivityCategoriesController@store');
Route::get   ('events/{event_id}/categoryactivities/{id}', 'ActivityCategoriesController@show');
Route::put   ('events/{event_id}/categoryactivities/{id}', 'ActivityCategoriesController@update');
Route::delete('events/{event_id}/categoryactivities/{id}', 'ActivityCategoriesController@destroy');


?>