<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventUserTest extends TestCase
{   
    const EVENT_ID = '61c9cd20b9e68935e11811d3';
    const EMAIL = "geraldine.garcia+2@mocionsoft.com";
    const NAMES = "JuliaNa";
    /**
     * Register user to an event and send confirmation email
     *
     * @return void
     */
    public function testSubscribeUserToEventAndSendEmail()
    {   
        $event_id = EventUserTest::EVENT_ID;
        $response = $this->postJson(`api/events/${event_id}/adduserwithemailvalidation`, 
            [
                'names' => EventUserTest::NAMES,
                'email' => EventUserTest::EMAIL
            ]
        );

        $response->assertStatus(200);
    }
}
