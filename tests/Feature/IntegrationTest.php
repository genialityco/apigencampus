<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// models
use App\Account;
use App\Event;
use App\Attendee;
use App\Activities;

class IntegrationTest extends TestCase
{
    /**
      * Test con CRUD basicos sobre
      * los modelos más importantes
      * en Evius.
      * Modularizar despúes
     *
     * @return void
     */
    // USERS
    public function test_user_store()
    {
	$this->postJson('/api/users', [
	   'email' => 'testing@evius.co',
	   'names' => 'Testing Evius',
	   'password' => 'testing123',
	 ]);

	// validar que el usuario se creo
	$this->assertDatabaseHas('users', ['email' => 'testing@evius.co']);
    }

    public function test_user_index()
    {
	$this
	    ->get('api/users')
	    ->assertStatus(200)
	    ->assertExactJson(["data" => "Can't query all users of the platform maximun scope is by event, please query particular user by _id or findByEmail"]);
    }

    public function test_user_show()
    {
	$user = Account::where('email', 'testing@evius.co')->first();
	$this
	  ->get("api/users/$user->_id")
	  ->assertStatus(200);
    }

    public function test_user_update()
    {
	$user = Account::where('email', 'testing@evius.co')->first();
	$this
	  ->withoutMiddleware()
	  ->putJson("api/users/$user->_id",
	   ['names' => 'Testing Evius Updated'])
	  ->assertStatus(200);

	$this->assertDatabaseHas('users', ['names' => 'Testing Evius Updated']);
    }

    public function test_user_delete()
    {
	$user = Account::where('email', 'testing@evius.co')->first();

	$this
	  ->withoutMiddleware()
	  ->delete("api/users/$user->_id");

	$this->assertDatabaseMissing('users', ['email' => $user->email]);
    }

    // EVENTS
    //public function test_event_store()
    //{
	//$this
	    //->postJson('/api/events?token=eyJhbGciOiJSUzI1NiIsImtpZCI6IjU4NWI5MGI1OWM2YjM2ZDNjOTBkZjBlOTEwNDQ1M2U2MmY4ODdmNzciLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoZGV2IiwiYXVkIjoiZXZpdXNhdXRoZGV2IiwiYXV0aF90aW1lIjoxNjY0MjAzODUwLCJ1c2VyX2lkIjoiWXgxZzk4RUI5OGdmaVM3NWtHUkdibHlka3M1MyIsInN1YiI6Ill4MWc5OEVCOThnZmlTNzVrR1JHYmx5ZGtzNTMiLCJpYXQiOjE2NjQ3NjUxMjksImV4cCI6MTY2NDc2ODcyOSwiZW1haWwiOiJsZW9uYXJkby5jYWljZWRvQG1vY2lvbnNvZnQuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImZpcmViYXNlIjp7ImlkZW50aXRpZXMiOnsiZW1haWwiOlsibGVvbmFyZG8uY2FpY2Vkb0Btb2Npb25zb2Z0LmNvbSJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.enTQa3HI40tr360m862O-mcPytUYKR8Fxjw7PBqmDGXowDx-Q2fGDyMuMUGDOvsdbq4ElSnT9vl1c-Tv1PhIXJdcNOOqeojDqtCuxfO7XQZmCO2ueevm2GsB85thh6GUEdTJv-vVl-7GDZGlUF0RLdn36DjsCnGaEHJS603jkVe9Ma1ds7cRDpZWWGB9yUCBNL_zJMpk53dqh0WHueFFnbUumAEb4hE-W4xxxXdMENW-ICuhwvaCVSNCNEa4rce_Dd_Sa7l5EeFXGO4U88w2BcrjPt8u-al2SWxbjbEaVbeBUxiVRaIBiMB8dZRHxNy3uBB6M2NEwarRBpPwcehVGg', [
		//'name' => 'Test Event',
		//'address' => null,
		//'author_id' => '62436d6e31700f045801a355',
		//'type_event' => 'onlineEvent',
		//'datetime_from' => '2022-01-06 17:38:00',
		//'datetime_to' => '2022-01-06 18:38:00',
		//'picture' => null,
		//'venue' => null,
		//'location' => null,
		//'visibility' => 'PUBLIC',
		//'category_ids' => [],
		//'description' => 'Test Event',
		//'organizer_id' => '62869866b67296398830f7b2',
		//'event_type_id' => '5bf47203754e2317e4300b68',
		//'user_properties' => [],
		//'allow_register' => true,
		//'styles' => [
		    //'buttonColor' => '#FFF',
		    //'banner_color' => '#FFF',
		    //'menu_color' => '#FFF',
		    //'brandPrimary' => '#FFFFFF',
		    //'brandSuccess' => '#FFFFFF',
		    //'brandInfo' => '#FFFFFF',
		    //'brandDanger' => '#FFFFFF',
		    //'containerBgColor' => '#ffffff',
		    //'brandWarning' => '#FFFFFF',
		    //'toolbarDefaultBg' => '#FFFFFF',
		    //'brandDark' => '#FFFFFF',
		    //'brandLight' => '#FFFFFF',
		    //'textMenu' => '#555352',
		    //'activeText' => '#FFFFFF',
		    //'bgButtonsEvent' => '#FFFFFF',
		    //'banner_image_email' => null,
		    //'BackgroundImage' => null,
		    //'FooterImage' => null,
		    //'banner_footer' => null,
		    //'mobile_banner' => null,
		    //'banner_footer_email' => null,
		    //'show_banner' => 'true',
		    //'show_card_banner' => false,
		    //'show_inscription' => false,
		    //'hideDatesAgenda' => true,
		    //'hideDatesAgendaItem' => false,
		    //'hideHoursAgenda' => false,
		    //'hideBtnDetailAgenda' => true,
		    //'loader_page' => 'no',
		    //'data_loader_page' => null
		//]
	    //])
	    //->assertStatus(201);

	//$this->assertDatabaseHas('events', ['name' => 'Test Event']);
    //}

    public function test_event_index()
    {
	$this
	    ->get('api/events')
	    ->assertStatus(200);
    }

    public function test_event_show()
    {
	$event = Event::where('name', 'Test Event')->first();
	$this
	  ->get("api/events/$event->_id")
	  ->assertJson(['name' => 'Test Event'])
	  ->assertStatus(200);
    }

    public function test_event_update()
    {
	$event = Event::where('name', 'Test Event')->first();
	$this
	  ->withoutMiddleware()
	  ->putJson("api/events/$event->_id",[
	      'description' => 'Test Event Updated'
	  ])
	  ->assertStatus(200);
	$this->assertDatabaseHas('events', ['description' => 'Test Event Updated']);
    }

    //public function test_event_delete()
    //{
	//$event = Event::where('name', 'Test Event')->first();
	//$this
	  //->withoutMiddleware()
	  //->delete("api/events/$event->_id")
	  //->assertStatus(204);

	//$this->assertDatabaseMissing('events', ['email' => $event->name]);
   //}

    // EVENT_USERS: se estara usando un id de evento quemado
    public function test_attendee_subscribe_to_event()
    {
	$this
	    ->postJson('api/events/6229243be0f66a1d14085237/adduserwithemailvalidation', [
		'properties' => [
			'names' => 'Testing Evius',
			'email' => 'testing@evius.co'
		    ]
	    ])
	    ->assertStatus(201);

	$this->assertDatabaseHas('event_users', [
	    'properties' => [
		'names' => 'Testing Evius',
		'email' => 'testing@evius.co'
	    ]
	]);
    }

    public function test_attendee_import_to_event()
    {
	$this
	    ->postJson('api/eventUsers/createUserAndAddtoEvent/6229243be0f66a1d14085237', [
		'names' => 'Testing Evius',
		'email' => 'testing@evius.co'
	    ])
	    ->assertStatus(200);

	$this->assertDatabaseHas('event_users', [
	    'properties' => [
		'names' => 'Testing Evius',
		'email' => 'testing@evius.co'
	    ]
	]);
    }

    public function test_attendee_index_by_event()
    {
	$this
	    ->withoutMiddleware()
	    ->get('api/events/6229243be0f66a1d14085237/eventusers')
	    ->assertStatus(200);
    }

    public function test_attendee_show()
    {
	$eventUser = Attendee::where('properties.email', 'testing@evius.co')->first();
	$this
	    ->withoutMiddleware()
	    ->get("api/events/6229243be0f66a1d14085237/eventusers/$eventUser->_id")
	    ->assertJson(['_id' => $eventUser->_id])
	    ->assertStatus(200);
    }

    public function test_attendee_update()
    {
	$eventUser = Attendee::where('properties.email', 'testing@evius.co')->first();
	$this
	    ->withoutMiddleware()
	    ->putJson("api/events/6229243be0f66a1d14085237/eventusers/$eventUser->_id", [
		'properties' => [
		    'names' => 'Testing Evius Updated'
		],
		'rol_id' => '60e8a7e74f9fb74ccd00dc22'
	    ])
	    ->assertStatus(200);


	$this->assertDatabaseHas('event_users', [
	    'properties' => [
		'names' => 'Testing Evius Updated',
		'email' => 'testing@evius.co',
		'rol_id' => '60e8a7e74f9fb74ccd00dc22'
	    ],
	]);
    }

    public function test_attendee_delete()
    {
	$eventUser = Attendee::where('properties.email', 'testing@evius.co')->first();
	$this
	    ->withoutMiddleware()
	    ->delete("api/events/627a9a1a1820ee5e5b3478b2/eventusers/$eventUser->_id");

	$this->assertDatabaseMissing('event_users', [
	    'properties' => [
		'names' => 'Testing Evius Updated',
		'email' => 'testing@evius.co',
		'rol_id' => '60e8a7e74f9fb74ccd00dc22'
	    ]
	]);
    }

    // ACTIVITIES
    public function test_activity_store()
    {
	$this
	    ->withoutMiddleware()
	    ->postJson('api/events/6229243be0f66a1d14085237/activities', [
		"name" => "Activity Test Evius",
		"subtitle" => "Activity Test Evius",
		"image" => "https://storage.googleapis.com\/herba-images\/evius\/events\/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg",
		"description" => "Activity Test Evius",
		"capacity" => 0,
		"event_id" => "6229243be0f66a1d14085237",
		"datetime_end" => "2020-10-14 14:11",
		"datetime_start" => "2020-10-14 14:50"
	    ]);

	$this->assertDatabaseHas('activities', [
	    "name" => "Activity Test Evius",
	]);
    }

    public function test_activity_index()
    {
	$this
	    ->get("api/events/6229243be0f66a1d14085237/activities/")
	    ->assertStatus(200);
    }

    public function test_activity_show()
    {
	$activity = Activities::where('name', 'Activity Test Evius')->first();

	$this
	    ->get("api/events/$activity->event_id/activities/$activity->_id")
	    ->assertStatus(200);
    }

    public function test_activity_update()
    {

	$activity = Activities::where('name', 'Activity Test Evius')->first();

	$this
	    ->withoutMiddleware()
	    ->putJson("api/events/$activity->event_id/activities/$activity->_id", [
		'name' => 'Activity Test Updated'
	    ])
	    ->assertStatus(200);

	$this->assertDatabaseHas('activities', [
	    'name' => 'Activity Test Updated'
	]);
    }

    public function test_activity_delete()
    {
	$activity = Activities::where('name', 'Activity Test Updated')->first();
	$this
	    ->withoutMiddleware()
	    ->delete("api/events/$activity->event_id/activities/$activity->_id");

	$this->assertDatabaseMissing('activities', [
	    'name' => 'Activity Test Updated'
	]);
    }
}
