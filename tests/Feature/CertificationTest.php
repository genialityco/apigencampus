<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;
// use App\Certification;

class CertificationTest extends TestCase
{
    const USER_ID = "62a911d3f83e7a6f4d5ecaf2";
    const EVENT_ID = "63c6979a2e12252adf60aef2";
    const ORGANIZATION_ID = "62a91349f83e7a6f4d5ecaf3";

    public function testIndex()
    {
        $organization_id = CertificationTest::ORGANIZATION_ID;
        $certification_log = $this->get("api/certifications/{$organization_id}");
        $certification_log->assertStatus(200);
    }

    public function testPostAndDelete()
    {
        $approved_from_date = Carbon::create(2023, 1, 24, 0, 0, 0);
        $approved_until_date = Carbon::create(2024, 1, 24, 0, 0, 0);

        $certification = $this->postJson("api/certifications", [
            "user_id" => CertificationTest::USER_ID,
            "event_id" => CertificationTest::EVENT_ID,
            "description" => "New certification old",
            "success" => true,
            "hours" => 40,
            "entity" => "Gov",
            "approved_from_date" => $approved_from_date,
            "approved_until_date" => $approved_until_date,
        ]);
        $certification->assertStatus(200);

        $user_id = $certification["user_id"];
        $event_id = $certification["event_id"];
        $response = $this->get("api/certifications?user_id={$user_id}&event_id={$event_id}");
        $response->assertStatus((200));
        $this->assertTrue($response["_id"] == $certification["_id"]);

        $this->assertTrue($certification["user_id"] == CertificationTest::USER_ID);
        $this->assertTrue($certification["event_id"] == CertificationTest::EVENT_ID);
        $this->assertTrue($certification["description"] == "New certification old");
        $this->assertTrue($certification["success"] == true);
        $this->assertTrue($certification["hours"] == 40);
        $this->assertTrue($certification["entity"] == "Gov");

        $double_certification = $this->postJson("api/certifications", [
            "user_id" => CertificationTest::USER_ID,
            "event_id" => CertificationTest::EVENT_ID,
            "description" => "Old certification new",
            "success" => false,
            "hours" => 80,
            "entity" => "ONG",
            "approved_from_date" => $approved_from_date,
            "approved_until_date" => $approved_until_date,
        ]);
        $double_certification->assertStatus(200);

        $this->assertTrue($double_certification["_id"] == $certification["_id"]);
        $this->assertTrue($double_certification["user_id"] == $certification["user_id"]);
        $this->assertTrue($double_certification["event_id"] == $certification["event_id"]);
        $this->assertTrue($double_certification["description"] == "Old certification new");
        $this->assertTrue($double_certification["success"] == false);
        $this->assertTrue($double_certification["hours"] == 80);
        $this->assertTrue($double_certification["entity"] == "ONG");

        $this->assertEquals(2, count($double_certification["certification_logs"]));

        $certification_id = $certification["_id"];
        $response = $this->delete("api/certifications/{$certification_id}");
        $response->assertStatus(200);
    }
}