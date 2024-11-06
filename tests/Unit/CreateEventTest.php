<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CreateEventTest extends TestCase
{
    private static $plan_id;

    const ID_PLAN_FREE = '';
    const USER_PLAN = '123';
    const USER_ID = '62828399fb70b46c9a386dcf';
    const COUNT_EVENTS = 1;
    /**
     * @group Create event Test
     */
    public function test_CreateEvent()
    {
        //User
        $user = $this->get("api/users/". CreateEventTest::USER_ID);
        self::$plan_id = $user->getOriginalContent()['plan_id'];
        $url = 'api/events?token=eyJhbGciOiJSUzI1NiIsImtpZCI6IjZmOGUxY2IxNTY0MTQ2M2M2ZGYwZjMzMzk0YjAzYzkyZmNjODg5YWMiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoZGV2IiwiYXVkIjoiZXZpdXNhdXRoZGV2IiwiYXV0aF90aW1lIjoxNjUzMzE0OTc0LCJ1c2VyX2lkIjoicTFVM3dBYkthTmRJd1JlbkJjRGdwOWNSVlU5MiIsInN1YiI6InExVTN3QWJLYU5kSXdSZW5CY0RncDljUlZVOTIiLCJpYXQiOjE2NTMzMjcwMzMsImV4cCI6MTY1MzMzMDYzMywiZW1haWwiOiJhbmRyZXMuY2FkZW5hQGV2aXVzLmNvIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImZpcmViYXNlIjp7ImlkZW50aXRpZXMiOnsiZW1haWwiOlsiYW5kcmVzLmNhZGVuYUBldml1cy5jbyJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.ZdhpdGEpfhoj_zIJkNVH00H2wa5nWnSFMNxM7QRbJD-Ifq8hZy5FISD_NsPUrFBPU4gFzG_-AKk-d5ekOMcy0nRZoWUR3_W6fYlNV1qBkeIt3EvZf0t51Oeax2U_HckOkepJqT78kUAIHshsIH_tgdFX3kU-G7vJU_pLkqXRIWOLlTQUAqbbU1trVmqAlj32iMEy3MRL-kDeaaM66FZvY0RFBOeWbDx5XHUJnC3TO5hK7w-wuM1McY8-UBvsvlzoAshcPQxiNjlBwd1lAavcEhWxJ64yoce-f1vK1k9-BA8EgQJNAbiPVTTTFQelLDu9SoKCSOj6YvWaSi-Y6h1W0w';

        //dd("user", self::$plan_id);
        $response = $this->postJson($url, [
            "name"=>"Test 2",
	        "address"=>null,
	        "type_event"=>"onlineEvent",
	        "datetime_from"=>"2022-01-06 17:38:00",
	        "datetime_to"=>"2022-01-06 18:38:00",
	        "picture"=>null,
	        "venue"=>null,
	        "location"=>null,
	        "visibility"=>"PUBLIC",
	        "description"=>null,
	        "category_ids"=>[
	        ],
	        "organizer_id"=>"6286c23425a5182d3573b7f2",
	        "event_type_id"=>"5bf47203754e2317e4300b68",
	        "user_properties"=>[
	        ],
	        "allow_register"=>true,
        ]);
        if (self::$plan_id == CreateEventTest::ID_PLAN_FREE) {
            $response->assertStatus(401);
        };
        $response->assertStatus(201);
    }
}
