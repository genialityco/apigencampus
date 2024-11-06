<?php

use Illuminate\Support\Facades\Route;

include "attendize/schedule.php";
include "roles/rolesOrganization.php";
include "roles/rolesAttendee.php";
include "organization/organization.php";
include "user/user.php";
include "user/userEvent.php";
include "mail.php";
include "test.php";
include "web.php";




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
To crate a new API for model please follow this guidelines:
| - the fist part indicating the model must be plural
| - use apiResource to create the CRUD
- use group middleware to restrict access for users and inside again apiResource
- add other methods separated trying to use API estandar and if It get complex create another controller
 */

/* EXAMPLE OF ROUTES PER MODEL using apiResourcelogin
Verb           URI                        Action     Route Name
GET            /photos                    index      photos.index
POST           /photos                    store      photos.store
GET            /photos/{photo}            show       photos.show
PUT/PATCH      /photos/{photo}            update     photos.update
DELETE         /photos/{photo}            destroy    photos.destroy
*/
// Route::get('s3aws/{prefix?}', 'AwsS3Controller');

/***************
 * AWS
 ****************/
Route::post('aws/messageupdatestatus', 'AwsSnsController@updateSnsMessages');
Route::get('aws/sendemail', 'AwsSnsController@testEmail');
Route::get('aws/test', 'AwsSnsController@testreqS3');

/****************
 * Events
 ****************/
Route::apiResource('events', 'EventController');
Route::post('events/{event}/restore', 'EventController@restore');
Route::put ('events/{event}/positions', 'EventController@updatePositions');
Route::group(
    ['middleware' => 'auth:token'],
    function () {        
        Route::post ('events/{event}', 'EventController@store')->middleware('permission:create');        
        Route::put ('events/{event}', 'EventController@update')->middleware('permission:update');
        Route::delete('events/{event}', 'EventController@destroy')->middleware('permission:destroy');
        Route::get('me/events', 'EventController@currentUserindex');
        //this routes should be erased after front migration
        Route::apiResource('user/events', 'EventController', ['except' => ['index', 'show']]);
        Route::middleware('auth:token')->get('user/events', 'EventController@currentUserindex');
        Route::put('events/{event}/changeStatusEvent', 'EventController@changeStatusEvent');
    }
);

Route::get('eventsbeforetoday', 'EventController@beforeToday');
Route::get('eventsaftertoday', 'EventController@afterToday');
Route::get('users/{user}/events', 'EventController@EventbyUsers');


Route::post('events/{event}/surveys/{id}/coursefinished', 'EventStatisticsController@courseFinished');


Route::post('googleanalytics', 'GoogleAnalyticsController');



Route::get('duncan/minutosparajugar', 'DuncanGameController@minutosparajugar');
Route::put('duncan/guardarpuntaje', 'DuncanGameController@guardarpuntaje');
// Route::post('duncan/invitaramigos', 'DuncanGameController@invitaramigos');
Route::get('duncan/setphoneaspassword', 'DuncanGameController@setphoneaspassword');



Route::get('generatorQr/{id}', 'GenerateQr@index');
Route::get('sync/firestore/{event}', 'synchronizationController@EventUsers');
Route::get('sync/firestore/{id}', 'synchronizationController@Attendee');
Route::get('sync/firebase/{id}', 'synchronizationController@EventUserRDT');

Route::put('events/{id}/updatestyles', 'EventController@updateStyles');

/****************
 * bigmaker.com conferencing integration
 * https://docs.bigmarker.com/#entering-a-conference
 ****************/
Route::post('integration/bigmaker/conferences/enter', 'IntegrationBigmarkerController@conferencesenter');


/***************
 * USER PROPERTIES EVENTS
 ****************/
Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::post('events/{event}/userproperties', 'UserPropertiesController@store')->middleware('permission:create');
        Route::delete('events/{event}/userproperties/{userpropertie}', 'UserPropertiesController@destroy')->middleware('permission:destroy');
        Route::put('events/{event}/userproperties/{userpropertie}', 'UserPropertiesController@update')->middleware('permission:update');
    }
);

Route::get('events/{event}/userproperties', 'UserPropertiesController@index');
Route::get('events/{event}/userproperties/{userpropertie}', 'UserPropertiesController@show');
Route::put('events/{event}/userproperties/{userpropertie}/RegisterListFieldOptionTaken', 'UserPropertiesController@RegisterListFieldOptionTaken');




/****************
 * meetings
 ****************/
Route::apiResource('networking', 'MeetingsController');
Route::get('event/{event}/meeting/{meeting_id}/accept', 'MeetingsController@accept');
Route::get('event/{event}/meeting/{meeting_id}/reject', 'MeetingsController@reject');

Route::get('event/{event}/meeting', 'MeetingsController@index');


/***************
 * SENDCONTENT  TEST CONTROLLER
 ****************/

Route::post('events/sendMecPerfil', 'SendContentController@sendContentGenerated');
Route::post('events/sendMecPerfilMec', 'SendContentController@sendContentMec');
Route::post('events/{event}/sendMecPerfilMectoall', 'SendContentController@sendContentToAll');
Route::post('events/sendnotificationemail', 'SendContentController@sendNotificationEmail');

Route::apiResource('events/{event}/sendcontent', 'SendContentController@index');


//Route::get('me/eventUsers', 'EventUserController@meEvents');






/***************
 * categories
 ****************/
// Route::group(
//     ['middleware' => 'cacheResponse'], function () {
Route::apiResource('categories', 'CategoryController', ['only' => ['index', 'show']]);

//     }
// );
Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::apiResource('categories', 'CategoryController', ['except' => ['index', 'show']]);
    }
);

/***************
 * Mail
 ****************/
Route::apiResource('events/{event}/mailing', 'MailController');

/***************
 * CERTIFICATES
 ****************/
Route::post('send-certificates/{event}', 'CertificateController@sendCertificateForAll');
Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::apiResource('certificates', 'CertificateController', ['except' => ['index', 'show']]);
        Route::get ('events/{event}/certificates', 'CertificateController@index');
        Route::post ('events/{event}/certificates', 'CertificateController@store')->middleware('permission:create');
        Route::get ('events/{event}/certificates/{certificate}', 'CertificateController@show');
        Route::put ('events/{event}/certificates/{certificate}', 'CertificateController@update')->middleware('permission:update');
        Route::delete('events/{event}/certificates/{certificate}', 'CertificateController@destroy')->middleware('permission:destroy');
        Route::post('generatecertificate', 'CertificateController@generateCertificate');
    }
);
// Duplicated but...
Route::get ('events/{event}/certificates', 'CertificateController@index');


/***************
 * Certificate
 ****************/
//Route::apiResource('certificate', 'CertificateController', ['only' => ['index', 'show']]);
Route::apiResource('certificate', 'CertificateController');
/*Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::apiResource('certificate', 'CertificateController', ['except' => ['index', 'show']]);
    }
);*/
/****************
 * eventTypes
 ****************/
Route::apiResource('eventTypes', 'EventTypesController', ['only' => ['index', 'show']]);


Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::apiResource('eventTypes', 'EventTypesController', ['except' => ['index', 'show']]);
    }
);

/****************
 * eventContents
 ****************/
Route::apiResource('eventContents', 'EventContentsController');

// Route::group(
//     ['middleware' => 'auth:token'], function () {
//         Route::apiResource('eventTypes', 'EventTypesController', ['except' => ['index', 'show']]);
//     }
// );

/****************
 * Escarapelas
 ****************/
Route::apiResource('escarapelas', 'EscarapelaController', ['only' => ['index', 'show']]);

Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::apiResource('escarapelas', 'EscarapelaController', ['except' => ['index', 'show']]);
    }
);

/****************
 * Contributors = STAFF
 ****************/
Route::group(
    ['middleware' => 'auth:token'],
    function () {

        //no sabemos como anteponerle el evento al apiresource lo deshabilitamos
        //Route::apiResource('contributors', 'ContributorController', ['except' => ['index']]);
        Route::get('events/{event}/contributors', 'ContributorController@index');
        Route::post('events/{event}/contributors', 'ContributorController@store');
        Route::get('events/{event}/contributors/{id}', 'ContributorController@show');
        Route::put('events/{event}/contributors/{id}', 'ContributorController@update');
        Route::delete('events/{event}/contributors/{id}', 'ContributorController@destroy');

        //Carga los roles
        Route::get('contributors/metadata/roles', 'ContributorController@metadata_roles');

        //Para cargar informaci�n de contributor del usuario actual
        Route::get('contributors/events/{event}/me', 'ContributorController@meAsContributor');
        Route::get('me/contributors/events', 'ContributorController@myEvents');

        //esto hace lo mismo que una ruta de arriba cual dejamos?
        Route::get('contributors/events/{event}', 'ContributorController@index');
    }
);

/****************
 * Contributors
 ****************/
//Route::group(
//['middleware' => 'auth:token'], function () {

// Burned
Route::get('events/{event}/burned-tickets', 'BurnedTicketController@index');
Route::get('events/{event}/burned-tickets/codes/{code}', 'BurnedTicketController@validateTicketCode');
Route::get('events/{event}/burned-tickets/download', 'BurnedTicketController@exportExcelWithBurnedTickets');
Route::get('events/{event}/burned-tickets/{burnedTicket}', 'BurnedTicketController@show');
Route::put('events/{event}/burned-tickets/{burnedTicket}', 'BurnedTicketController@update');
Route::post('attendees/ticket-category/{ticketCategory}/validate', 'BurnedTicketController@validateUserDataToTicket');
Route::get('events/{event}/burned-categories', 'TicketCategoryController@indexBurnedBoleteria');

// LUKER
Route::post('events/{event}/luker/tickets', 'LukerTicketController@store');

Route::apiResource('events/{event}/tickets', 'TicketController', ['except' => ['store']]);
Route::post('ticket-categories/{ticketCategory}/tickets', 'TicketController@store');
Route::put('users/{user}/tickets/{ticket}/assign', 'TicketController@assingTicketToUser');
Route::post('users/{user}/billings/{billing}/tickets', 'TicketController@createTicketByBilling');
Route::put('events/{event}/tickets/{ticket}/redeem', 'TicketController@redeemTicket');

//Route::get('ajustarticketid', 'API\EventTicketsAPIController@ajustarticketid');
// }
//);

/****************
 * Speakers
 ****************/
// Route::group(
// ['middleware' => 'auth:token'], function () {
Route::apiResource('events/{event}/speakers', 'SpeakerController');
// }
// );

/****************
 * Event Sessions
 ****************/
// Route::group(
// ['middleware' => 'auth:token'], function () {
Route::apiResource('events/{event}/sessions', 'EventSessionController');
// }
// );

/****************
 * Orders Events
 ****************/
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::post('events/{event}/orders/create-preorder', 'ApiOrdersController@createPreOrder');
        Route::put('orders/{order}/create-tickets', 'ApiOrdersController@updateOrderAndAddTickets');
        Route::post('events/{event}/orders/create-order-to-partner', 'ApiOrdersController@createOrderToPartner');
    }
);
Route::put('orders/{order}/create-alternative-tickets', 'ApiOrdersController@alternativeTicket');
Route::get('orders/tickets-available/{event}', 'ApiOrdersController@getTicketsAvailable');

Route::apiResource('orders', 'ApiOrdersController');
Route::post('orders/{order_id}/validateFreeorder', 'ApiCheckoutController@validateFreeOrder');
Route::post('orders/{order_id}/validatePointOrder', 'ApiCheckoutController@validatePointOrder');
Route::post('orders/{order_id}/validatePointOrderTest', 'ApiCheckoutController@validatePointOrderTest');

Route::get('events/{event}/orders/ordersevent', 'ApiOrdersController@indexByEvent');

// Route::get('orders/{order_id}', 'ApiOrdersController@show');
Route::post("payment_webhook_response", "ApiCheckoutController@paymentWebhookesponse");

/****************
 * Orders Users
 ****************/
// ['middleware' => 'auth:token'], function () {
// Route::apiResource('users/{user_id}/orders/', 'OrdersController@ordersByUsers');
Route::get('users/{user_id}/orders/', 'ApiOrdersController@ordersByUsers');
Route::get('me/orders/', 'ApiOrdersController@meOrders');
Route::get('orders/{organization_id}/orderOrganization', 'ApiOrdersController@indexByOrganization');


// }
// );

// Route::apiResource('photos', 'PhotoController');

/* FROM HERE DOWNWARDS UNORGANIZED API ROUTES  WILL DISAPEAR */

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
}); */
Route::resource('messageUser', 'MessageUserController');
Route::get('events/{event}/message/{message_id}/messageUser', 'MessageUserController@indexMessage');

Route::get('testsendemail', 'TestingController@sendemail');
Route::get('testqr', 'TestingController@qrTesting');
Route::get('pdftest', 'TestingController@pdf');
Route::get('confirmationEmail/{id}', 'TestingController@sendConfirmationEmail');
Route::get('confirmEmail/{id}', 'UserController@confirmEmail');
Route::get('borradorepetidos/activity/{activity_id}', 'ActivityAssistantController@borradorepetidos');


Route::post('order/{order_id}/resend', [
    'as' => 'resendOrder',
    'uses' => 'EventOrdersController@resendOrder',
]);

//Routes for create a new webhooks in Sendinblue API and Update status of messages send by sendinblue


/**
 * This is the routes of event types
 * You can find differents option how get, post, put, deleted
 *
 */

//Events

// Route::middleware('auth:token')->get('permissions/{id}', 'PermissionEventController@getUserPermissionByEvent');

//Account Events Endpoint
Route::post('user/events/{id}/addUserProperty', 'EventController@addUserProperty');



Route::get('states', 'StateController@index');






//MISC Controllers
Route::post("files/upload/{field_name?}", "FilesController@upload");
Route::post("files/uploadbase/{name}", "FilesController@storeBaseImg");

// Upload vimeo video
Route::post("vimeo/upload", "VimeoVideoController@uploadVideo");
Route::get("vimeo/download", "VimeoVideoController@downloadVideo");
Route::get("vimeo/status", "VimeoVideoController@videoStatus");

//Rol EndPoint
// Route::get('events/{event}/rols', 'RolEventController@index');
Route::middleware('auth:token')->get('rols', 'RolController@index');
// Route::post('rols', 'RolEventController@store');
// Route::put('rols/{id}', 'RolEventController@update');
// Route::get('rols/{id}', 'RolEventController@show');
Route::get('rols/{id}/rolseventspublic', 'RolController@showRolPublic');
// Route::post('roles/{role}/addpermissions', 'RolesPermissionsEventController@addPermissionToRol');

Route::get('rolespermissionsevents/findbyrol/{rol}', 'RolesPermissionsEventController@indexByRol');
/**
 * REQUEST OF PLACETOPAY
 * https://api.evius.co/api/order/paymentCompleted
 */
Route::post("order/paymentCompleted", "EventCheckoutController@paymentCompleted");
Route::get("order/complete/{order_id}", "EventCheckoutController@completeOrder");
Route::post("postValidateTickets", "EventCheckoutController@postValidateTickets");



/****************
 * DiscountCodes
 ****************/
Route::apiResource("discountcodetemplate", "DiscountCodeTemplateController");
Route::post("discountcodetemplate/{id}/importCodes", "DiscountCodeTemplateController@importCodes");
Route::get("discountcodetemplate/findByOrganization/{organization}", "DiscountCodeTemplateController@findByOrganization");


//y esto que fue? ese api más sospechozso
Route::apiResource("discountcodetemplate/{template_id}/code", "DiscountCodeController");
Route::put("code/exchangeCode", "DiscountCodeController@exchangeCode");
Route::post("code/validatecode", "DiscountCodeController@validateCode");
Route::put("code/redeem_point_code",  "DiscountCodeController@redeemPointCode");
Route::get("code/codesByUser",  "DiscountCodeController@codesByUser");

Route::get("organization/{organization}/ordersUsersPoints",  "OrganizationController@ordersUsersPoints");


/****************
* Product
****************/
Route::group(
    ['middleware' => 'auth:token'], function () {
        Route::post('events/{event}/products', 'ProductController@store')->middleware('permission:create');
        Route::put('events/{event}/products/{product}', 'ProductController@update')->middleware('permission:update');
        Route::delete('events/{event}/products/{product}', 'ProductController@destroy')->middleware('permission:destroy');
        Route::post('events/{event}/products/{product}/silentauctionmail', 'ProductController@createSilentAuction')->middleware('permission:send_products_silentauctiomail');
    }
);

Route::get('events/{event}/products', 'ProductController@index');
Route::get('events/{event}/products/{product}', 'ProductController@show');


/****************
 * Comment
 ****************/
Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::post('comments', 'CommentController@store');
        Route::put('comments/{comment}', 'CommentController@update');
        Route::delete('comments/{comment}', 'CommentController@destroy');
        Route::get('comments', 'CommentController@index');
    }
);


// ------------------------------------------------------TEST
Route::put('codestest', 'DiscountCodeController@codesTest');



/****************
 * DocumenUser
 ****************/
//Route::group(
//['middleware' => 'auth:token'], function () {
//Route::get('events/{event}/documentusers', 'DocumentUserController@index'); 
//}
//);

/****************
 * DocumenUser
 ****************/
Route::get('events/{event}/documentusers', 'DocumentUserController@index');
Route::get('events/{event}/documentusers/{documentuser}', 'DocumentUserController@show');
Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::post('events/{event}/documentusers', 'DocumentUserController@store')->middleware('permission:create');
        Route::put('events/{event}/documentusers/{documentuser}', 'DocumentUserController@update')->middleware('permission:update');
        Route::delete('events/{event}/documentusers/{documentuser}', 'DocumentUserController@destroy')->middleware('permission:destroy');
        // retorna todos los documentos de un usuario de un evento
        Route::get('events/{event}/me/documentusers', 'DocumentUserController@documentsUserByUser');
        Route::put('events/{event}/adddocumentuser', 'EventController@addDocumentUserToEvent');        
    }
);

/** 
 *  ROUTES My Plan */

/*****
 * Current plan
 */

//Route::get('users/{user}/currentPlan', 'UserController@currentPlanInfo');

/** 
 *  ROUTES RESTRICCION */

 /*****
 * Coupons
 */

// Route::get('coupons/{name}', 'CouponsController@findByName');
// Route::post('coupons', 'CouponsController@store')->middleware('permission:create');

/*****
 * Plan
 */

Route::apiResource('plans', 'PlansController');

/*****
 * Notification
 */

// Route::apiResource('notifications', 'NotificationController');
// Route::get('users/{user}/notifications', 'NotificationController@NotificationbyUser');

/*****
 * Billing
 */

Route::apiResource('billings', 'BillingController');
Route::get('users/{user}/billings', 'BillingController@BillingbyUser');
Route::get('reference/{reference}/billings', 'BillingController@findByReference');
Route::put('reference/{reference}/billings', 'BillingController@updateByReference');
Route::post('billings/tickets', 'BillingController@storeTickets');

/*****
 * PreBilling
 */

Route::post('preBilling', 'PreBillingController@store');

Route::post('preBilling', 'PreBillingController@store');
/*****
 * Payment
 */

Route::apiResource('payments', 'PaymentController');
Route::get('users/{user}/payments', 'PaymentController@PaymentbyUser');

/*****
 * Addons
 */

// Route::apiResource('addons', 'AddonController');
// Route::get('users/{user}/addons', 'AddonController@AddonbyUser');

/*****
 * PreviewLanding
 */

Route::apiResource('previews', 'PreviewLandingController');
Route::get('event/{event}/previews', 'PreviewLandingController@PreviewsbyEvent');
Route::post('event/{event}/addmanypreviews', 'PreviewLandingController@CreateMany');


/*****
 * Description events
 */

Route::apiResource('descriptions', 'DescriptionController');
Route::get('event/{event}/descriptions', 'DescriptionController@DescriptionbyEvent');
Route::put('event/{event}/updateDescriptions', 'DescriptionController@updateMany');
Route::post('event/{event}/addDescriptions', 'DescriptionController@storeMany');

//GUESS
Route::get('guess-pass', 'UserController@guessPassword');

/*****
 * Ticket Categories
 */

Route::get('boleterias/{boleteria}/ticket-categories', 'TicketCategoryController@index');
Route::post('boleterias/{boleteria}/ticket-categories', 'TicketCategoryController@store');
Route::get('boleterias/{boleteria}/ticket-categories/{ticketCategory}', 'TicketCategoryController@show');
Route::put('boleterias/{boleteria}/ticket-categories/{ticketCategory}', 'TicketCategoryController@update');
Route::delete('boleterias/{boleteria}/ticket-categories/{ticketCategory}', 'TicketCategoryController@destroy');

// Bingo
Route::post('events/{event}/bingos', 'BingoController@store');
Route::put('events/{event}/bingos/{bingo}', 'BingoController@update');
Route::delete('events/{event}/bingos/{bingo}', 'BingoController@destroy');
Route::post('events/{event}/bingos/{bingo}/values', 'BingoController@addBingoValue');
Route::put('events/{event}/bingos/{bingo}/values/{value}', 'BingoController@editBingoValues');
Route::delete('events/{event}/bingos/{bingo}/values/{value}', 'BingoController@deleteBingoValue');
//Route::put('events/{event}/bingos/{bingo}/random-values', 'BingoController@createRandomBingoValues');
Route::put('events/{event}/bingos/{bingo}/reset-bingo-cards', 'BingoController@resetBingoCards');
Route::put('events/{event}/bingos/{bingo}/import-values', 'BingoController@importBingoValues');
//BingobyEvent
Route::get('events/{event}/bingos', 'BingoController@BingobyEvent');

//BINGOCARD
Route::get('bingocards/{code}', 'BingoCardController@show');
Route::get('bingocards/{bingocard}/download', 'BingoCardController@downloadBingoCard');

//eliminar despues, esto es un favor para mocion
Route::post('correos-mocion', 'EventUserController@correosMocion');

//NEXMO SEND SMS
Route::post('nexmo-send-sms/events/{event}', 'SmsController@generalSendSms');
Route::post('nexmo-send-sms/events/{event}/filter', 'SmsController@filterSendindSms');
//TWILIO SEND SMS
//Route::get('twilio-send-sms', 'WhatsappController@sendMsg');

//REDIRECT TO LANDING
Route::get('invitation/{code}', 'UrlController@redirectToLanding');

//SHARE PHOTO
Route::apiResource('sharephoto', 'SharePhotoController');
Route::put('sharephoto/{share_photo}/addpost', 'SharePhotoController@addOnePost');
Route::delete('sharephoto/{share_photo}/post/{post_id}', 'SharePhotoController@removePost');
Route::put('sharephoto/{share_photo}/addlike/{post_id}', 'SharePhotoController@addOneLike');
Route::delete('sharephoto/{share_photo}/unlike/{post_id}', 'SharePhotoController@unlike');
Route::get('events/{event}/sharephotos', 'SharePhotoController@SharePhotoByEvent');

//WHERE IS
Route::apiResource('whereis', 'WhereIsController');
Route::put('whereis/{where_is}/addresponse', 'WhereIsController@addOneResponse');
Route::delete('whereis/{where_is}/responses/{response_id}', 'WhereIsController@removeResponse');
Route::get('events/{event}/whereis', 'WhereIsController@WhereIsbyEvent');

//WHO WANTS TO BE MILLIONAIRE
Route::post('events/{event}/millionaires', 'MillionaireController@store');
Route::put('events/{event}/millionaires/{millionaire}', 'MillionaireController@update');
Route::delete('events/{event}/millionaires/{millionaire}', 'MillionaireController@destroy');
//MillionairebyEvent
Route::get('events/{event}/millionaires', 'MillionaireController@MillionairebyEvent');
//Add || update || delete  => stage
Route::post('millionaires/{millionaire}/stages', 'MillionaireController@addStage');
Route::put('millionaires/{millionaire}/stages/{stage}', 'MillionaireController@updateStage');
Route::delete('millionaires/{millionaire}/stages/{stage}', 'MillionaireController@removeStage');
//Add || update || delete => question
Route::post('millionaires/{millionaire}/questions', 'MillionaireController@addOneQuestion');
Route::put('millionaires/{millionaire}/questions/{question}', 'MillionaireController@updateQuestion');
Route::delete('millionaires/{millionaire}/questions/{question}', 'MillionaireController@removeOneQuestion');
//Assing question to stage
Route::put('millionaires/{millionaire}/stages/{stage}/questions/{question}', 'MillionaireController@assignQuestionToStage');
//Import questions
Route::put('millionaires/{millionaire}/import-questions', 'MillionaireController@importQuestions');
//Add || update || delete => answer 
Route::post('millionaires/{millionaire}/questions/{question}/answers', 'MillionaireController@addOneAnswer');
Route::put('millionaires/{millionaire}/questions/{question}/answers/{answer}', 'MillionaireController@updateAnswer');
Route::delete('millionaires/{millionaire}/questions/{question}/answers/{answer}', 'MillionaireController@removeOneAnswer');

// Route::get('user/{id}', 'UserController@show');
// Route::post('user/{user_id}/positions', 'UserController@updatePosition');
//ROUTES TEMPLATES BINGO
Route::apiResource('bingotemplates', 'TemplateBingosController');
//get templates by format
Route::get('bingotemplates/format/{format}', 'TemplateBingosController@getTemplatesByFormat');

/****************
 * Boleteria
 ****************/
Route::post('events/{event}/boleterias', 'BoleteriaController@store');
Route::put('events/{event}/boleterias/{boleteria}', 'BoleteriaController@update');

// Tools
//Route::group(
    //['middleware' => 'auth:token'],
    //function () {
    Route::get('events/{event}/tools', 'ToolController@index');
    Route::post('events/{event}/tools', 'ToolController@store');
    Route::get('events/{event}/tools/{tool}', 'ToolController@show');
    Route::put('events/{event}/tools/{tool}', 'ToolController@update');
    Route::delete('events/{event}/tools/{tool}', 'ToolController@destroy');
    //}
//)

/**
 * Endpoints for positions
 */

Route::get('positions', 'PositionController@index');
Route::post('positions', 'PositionController@store');
Route::get('positions/clean', 'PositionController@clean');
Route::get('positions/{position_id}', 'PositionController@show');
Route::delete('positions/{position_id}', 'PositionController@destroy');
Route::put('positions/{position_id}', 'PositionController@update');

Route::get('positions/{position_id}/organization/{organization_id}/users', 'PositionController@indexUsersForOrganizationAtPosition');
Route::post('positions/{position_id}/organization/{organization_id}/users', 'PositionController@storeUsersForOrganizationAtPosition');
Route::put('positions/{position_id}/organization/{organization_id}/events', 'PositionController@updateEventsUsersForOrganizationAtPosition');
Route::delete('positions/{position_id}/organization/{organization_id}/users/{user_id}', 'PositionController@deleteUserForOrganizationAtPosition');

Route::get('positions/{position_id}/organization/{organization_id}', 'PositionController@showForOrganization');
Route::get('positions/organization/{organization_id}', 'PositionController@indexForOrganization'); // @deprecated use index() instead
Route::post('positions/organization/{organization_id}', 'PositionController@storeForOrganization');

/**
 * Endpoints for modules
 */

Route::get('modules', 'ModuleController@index');
Route::post('modules', 'ModuleController@store');
Route::get('modules/{module_id}', 'ModuleController@show');
Route::delete('modules/{module_id}', 'ModuleController@destroy');
Route::put('modules/{module_id}', 'ModuleController@update');

Route::get('modules/{module_id}/activities', 'ModuleController@showAllActivities');
Route::put('modules/{module_id}/activities', 'ModuleController@updateActivityIds');
Route::get('modules/activity/{activity_id}/modules', 'ModuleController@showModulesForActivity');
Route::get('modules/event/{event_id}/with-no-module/activities', 'ModuleController@showAllActivitiesWithoutModule');

Route::get('modules/event/{event_id}/modules', 'ModuleController@showModulesForEvent');
// Route::post('modules/event/{event_id}/modules', 'ModuleController@storeModulesForEvent');

/**
 * Endpoints for certification logs
 */

Route::post('certification-logs', 'CertificationLogController@store');
Route::get('certification-logs', 'CertificationLogController@index');
Route::get('certification-logs/{certification_log_id}', 'CertificationLogController@show');
Route::put('certification-logs/{certification_log_id}', 'CertificationLogController@update');
Route::delete('certification-logs/{certification_log_id}', 'CertificationLogController@destroy');
Route::get('certification-logs/event-certification-logs/{event_id}', 'CertificationLogController@indexFromEvent');


/**
 * Endpoints for certification
 */

Route::post('certifications', 'CertificationController@store');
Route::get('certifications', 'CertificationController@indexCustom');
Route::get('certifications/by-position/{positionId}', 'CertificationController@indexByPosition');
Route::get('certifications/{organization_id}', 'CertificationController@index');
Route::get('certifications/{certification_id}', 'CertificationController@show');
Route::put('certifications/{certification_id}', 'CertificationController@update');
Route::delete('certifications/{certification_id}', 'CertificationController@destroy');
Route::post('certifications/import', 'CertificationController@addLog');

Route::group(
    ['middleware' => 'auth:token'],
    function() {
        Route::get('events/{event}/boleterias', 'BoleteriaController@index');
        Route::post('events/{event}/boleterias', 'BoleteriaController@store');
        Route::get('events/{event}/boleterias/{boleteria}', 'BoleteriaController@show');
        Route::put('events/{event}/boleterias/{boleteria}', 'BoleteriaController@update');
        Route::delete('events/{event}/boleterias/{boleteria}', 'BoleteriaController@destroy');
    }
);

/****************
 * WebHook
 ****************/
Route::post('wompi/transactions', 'WebHookController@mainHandler');
Route::get('wompi/get-stored-event/{id}', 'WebHookController@getStoredEvent');
/**
 * Don't dirty the logs please
 */
// Route::fallback(function (Illuminate\Http\Request $request) {
//     // abort(404);
//     $message = 'The path ' . $request->method() . ' ' . $request->path() . ' DOES NOT exist :)';
//     return response()->json([
//         'error' => true,
//         'message' => $message,
//     ], 404);
// })->where('any', '.*');

Route::get('attendee-report/{eventId}', 'AttendeeReportController@getAllByEvent');

Route::put('activities/{activityId}/content', 'ActivityContentController@update');
Route::delete('activities/{activityId}/content', 'ActivityContentController@destroy');
