<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Event;
use App\Boleteria;

class BoleteriaTest extends TestCase
{
    const event_id = '6377db980362f94dc23b6532';

    /**
     * verify type of access.
     * No se puede crear boleteria
     * si el tipo de acceso es diferente a
     * público con registro
     *
     * @return void
     */
    public function test_verify_type_of_access()
    {
	// cambiar tipo de acceso del event
	$event = Event::findOrFail(self::event_id);
	$event->allow_register = false;
	$event->save();

	$this
	    ->post('/api/events/'.self::event_id.'/boleterias/')
	    ->assertStatus(403)
	    ->assertExactJson([
		'message' => "Type of event acceso must be 'Mandatory registration with authentication'"
	    ]);

	$event->allow_register = true;
	$event->save();
    }

    public function test_create_boleteria()
    {
	// crear boleteria
	$this
	    ->postJson('/api/events/'.self::event_id.'/boleterias/', [
		'title' => 'Nueva boleteria'])
		->assertStatus(201);

	// asociarla al evento
	$this->assertDatabaseHas('boleterias', ['title' => 'Nueva boleteria']);
    }

    public function test_update_boleteria()
    {
	$boleteria = Boleteria::where('event_id', self::event_id)->first();
	$this
	  //->withoutMiddleware()
	  ->putJson('api/events/'.self::event_id."/boleterias/$boleteria->_id",
	   ['names' => 'Testing Evius Updated'])
	  ->assertStatus(200);

	$this->assertDatabaseHas('users', ['names' => 'Testing Evius Updated']);
    }
}
