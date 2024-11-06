<?php

use Illuminate\Support\Facades\Route;

/****************
 * SPACES
 ****************/

Route::get ('events/{event}/spaces', 'SpaceController@index');
Route::get ('events/{event}/spaces/{space}', 'SpaceController@show');
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::post ('events/{event}/spaces', 'SpaceController@store')->middleware('permission:create');
        Route::put ('events/{event}/spaces/{space}', 'SpaceController@update')->middleware('permission:update');
        Route::delete('events/{event}/spaces/{space}', 'SpaceController@destroy')->middleware('permission:destroy');
    }
);


/****************
 * APP CONFIGURATION
 ****************/
Route::apiResource('event/{id}/configuration', 'AppConfigurationController');
Route::delete('event/{id}/configuration', 'AppConfigurationController@delete');

/****************
 * NEWSFEED
 ****************/
Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::post('events/{event}/newsfeed','NewsfeedController@store')->middleware('permission:create');
        Route::put('events/{event}/newsfeed/{newsfeed}','NewsfeedController@update')->middleware('permission:update');
        Route::delete('events/{event}/newsfeed/{newsfeed}','NewsfeedController@destroy')->middleware('permission:destroy');
    }
);

Route::get('events/{event}/newsfeed','NewsfeedController@index');
Route::get('events/{event}/newsfeed/{newsfeed}','NewsfeedController@show');

/***************
 * HOST
 * rutas para guardar la agenda de los eventos
 ****************/

Route::post  ('events/{event}/duplicatehost/{id}','HostController@duplicate');

Route::get('events/{event}/host' , 'HostController@index');
Route::get('events/{event}/host/{host}' , 'HostController@show');
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::post('events/{event}/host' , 'HostController@store')->middleware('permission:create');
        Route::put('events/{event}/host/{host}' , 'HostController@update')->middleware('permission:update');
        Route::delete('events/{event}/host/{host}' , 'HostController@destroy')->middleware('permission:destroy');
    }
);

/***************
 * ACTIVITIES
 ****************/

Route::post  ('/meetingrecording',      'ActivitiesController@storeMeetingRecording');
Route::post  ('events/{event}/duplicateactivitie/{id}',      'ActivitiesController@duplicate');
Route::get  ('events/{event}/activitiesbyhost/{host_id}',      'ActivitiesController@indexByHost');
Route::post  ('events/{event}/createmeeting/{id}', 'ActivitiesController@createMeeting');
Route::put('events/{event}/activities/{id}/hostAvailability' ,  'ActivitiesController@hostAvailability');
Route::post   ('events/{event}/activities/{id}/register_and_checkin_to_activity',  'ActivitiesController@registerAndCheckInActivity');
Route::put('events/{event}/activities/mettings_zoom/{meeting_id}' ,  'ActivitiesController@deleteVirtualSpaceZoom');

Route::get('events/{event}/activities','ActivitiesController@index')->middleware('permissionAttendee:list_activities|read');

Route::get('events/{event}/activities/{activitie}','ActivitiesController@show');
// Temporally set
Route::put('events/{event}/activities/{activity}','ActivitiesController@update');
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::post('events/{event}/activities/{activity}/checkinbyadmin',  'ActivitiesController@checkinbyadmin')->middleware('permission:create_checkinbyadmin');
        //CRUD
        
        Route::post('events/{event}/activities','ActivitiesController@store')->middleware('permission:create');
        // Route::put('events/{event}/activities/{activity}','ActivitiesController@update')->middleware('permission:update');
        Route::delete('events/{event}/activities/{activity}','ActivitiesController@destroy')->middleware('permission:destroy');
    }
);


/***************
 * TYPE
 ****************/
Route::apiResource('events/{event}/type','TypeController');

/***************
 * ACTIVITYCATEGORIES (las categorias para las actividades de la agenda)
 ****************/
Route::apiResource('events/{event}/categoryactivities',      'ActivityCategoriesController');

/***************
 * TEST API'S
 ****************/
// Route::apiResource('testsendrecovery', 'TestEmailRecoveryController',['only' => ['index']]);
Route::post('findbase/findbase/{id}', 'SendContentController@Attendee');
Route::post('saveImagesInStorage' , "SendContentController@saveImagesInStorage");
// Route::post("verifyuser","VertifyController@validateUser");


/*******************
 * RECOVERY PASSWORD
 ******************/
Route::post('events/{event}/recoverypassword', 'SendContentController@PasswordRecovery');


/********************
 * PUSH NOTIFICATIONS
 ********************/
Route::apiResource('events/{event}/sendpush', 'PushNotificationsController');
//Route::post('event/{event}/sendpush', 'SendContentController@sendPushNotification');
Route::get('event/{event}/notifications/{id}', 'PushNotificationsController@indexByUser');



/*******************
 * DOCUMENTS UPLOAD
 ******************/
Route::apiResource('events/{event}/documents', 'DocumentsController');
Route::get('events/{event}/getallfiles/', 'DocumentsController@indexFiles');
 

/*******
 * WALL
 ******/
Route::apiResource('events/{event}/wall', 'WallController');
 
 

/*******************
 * FAQ'S
 ******************/

Route::get('events/{event}/faqs' , 'FaqController@index');
Route::get('events/{event}/faqs/{faqs}' , 'FaqController@show');
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::post('events/{event}/faqs' , 'FaqController@store')->middleware('permission:create');
        Route::put('events/{event}/faqs/{faqs}' , 'FaqController@update')->middleware('permission:update');
        Route::delete('events/{event}/faqs/{faqs}' , 'FaqController@destroy')->middleware('permission:destroy');
    }
);


Route::post ('events/{event}/duplicatefaqs/{id}','FaqController@duplicate');

//TEST 
Route::put('events/{id}/zoomhost', 'ZoomHostController@update');
Route::post('events/zoomhost', 'ZoomHostController@updateStatus');
Route::get('events/zoomhost', 'ZoomHostController@index');

/*******
 * RSVP
 ******/
 Route::post("events/{event}/wallnotifications", "RSVPController@wallActivity");



/****************
* Surveys
****************/
Route::put('events/{event}/questionedit/{id}', 'SurveysController@updatequestions');
Route::get('events/{event}/surveys/{surveys}', 'SurveysController@show');    
Route::get('events/{event}/surveys', 'SurveysController@index');
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::post('events/{event}/surveys', 'SurveysController@store')->middleware('permission:create');                  
        Route::put('events/{event}/surveys/{surveys}', 'SurveysController@update')->middleware('permission:update');
        Route::delete('events/{event}/surveys/{surveys}', 'SurveysController@destroy')->middleware('permission:destroy');
    }
);
Route::get('surveys/{survey}/eventusers/{eventuser}/sendcode', 'SurveysController@sendCode');
Route::get('surveys/{survey}/open', 'SurveysController@redirectToLanding');
Route::get('surveys/{survey}/open-manual', 'SurveysController@redirectManualAll');
Route::get('surveys/{survey}/sendcodeall', 'SurveysController@sendCodeAll');


// /****************
// * Style
// ****************/
// Route::get('events/{event}/stylestemp', 'StylesController@indexTemp');
// Route::get('styles/{style}', 'StyleController@show');
// Route::get('styles', 'StyleController@index');
// Route::group(
//     ['middleware' => 'auth:token'], function () {        
//         Route::post('styles', 'StyleController@store')->middleware('permission:create');                      
//         Route::put('styles/{style}', 'StyleController@update')->middleware('permission:update');
//         Route::delete('styles/{style}', 'StyleController@destroy')->middleware('permission:destroy');
//     }
// );