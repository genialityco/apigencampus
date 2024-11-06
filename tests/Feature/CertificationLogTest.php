<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;
// use App\CertificationLog;

class CertificationLogTest extends TestCase
{
    const USER_ID = "62a911d3f83e7a6f4d5ecaf2";
    const EVENT_ID = "63c6979a2e12252adf60aef2";

    public function testIndex()
    {
        $certification_log = $this->get("api/certification-logs");
        $certification_log->assertStatus(200);
    }

    public function testGoodPostAndDelete()
    {
        $approved_from_date = Carbon::create(2023, 1, 24, 0, 0, 0);
        $approved_until_date = Carbon::create(2024, 1, 24, 0, 0, 0);

        $certification_log = $this->postJson(
            "api/certification-logs",
            [
                "user_id" => CertificationLogTest::USER_ID,
                "event_id" => CertificationLogTest::EVENT_ID,
                "success" => true,
                "approved_from_date" => $approved_from_date,
                "approved_until_date" => $approved_until_date,
            ]
        );
        $certification_log->assertStatus(200);
        $this->assertTrue($certification_log["success"] == true);
        $this->assertTrue($certification_log["user_id"] == CertificationLogTest::USER_ID);
        $this->assertTrue($certification_log["event_id"] == CertificationLogTest::EVENT_ID);
        $this->assertTrue($certification_log["approved_from_date"] == $approved_from_date);
        $this->assertTrue($certification_log["approved_until_date"] == $approved_until_date);

        $response = $this->delete("api/certification-logs/".$certification_log["_id"]);
        $response->assertStatus(200);
    }

    public function testBadForMissingIDsPostAndBadDelete()
    {
        $bad_user_id = "this-user-does-not-exist";
        $bad_event_id = "that-event-does-not-exist";
        $approved_from_date = Carbon::yesterday();
        $approved_until_date = Carbon::now();

        $certification_log = $this->postJson(
            "api/certification-logs",
            [
                "user_id" => CertificationLogTest::USER_ID,
                "event_id" => $bad_event_id,
                "success" => true,
                "approved_from_date" => $approved_from_date,
                "approved_until_date" => $approved_until_date,
            ]
        );
        $certification_log->assertStatus(404);

        $certification_log = $this->postJson(
            "api/certification-logs",
            [
                "user_id" => $bad_user_id,
                "event_id" => CertificationLogTest::EVENT_ID,
                "success" => true,
                "approved_from_date" => $approved_from_date,
                "approved_until_date" => $approved_until_date,
            ]
        );
        $certification_log->assertStatus(404);

        $response = $this->delete("api/certification-logs/this-id-does-not-exist");
        $response->assertStatus(404);
    }

    public function testUpdate()
    {
        $approved_from_date = Carbon::create(2023, 1, 24, 0, 0, 0);
        $approved_until_date = Carbon::create(2024, 1, 24, 0, 0, 0);

        $certification_log = $this->postJson(
            "api/certification-logs",
            [
                "user_id" => CertificationLogTest::USER_ID,
                "event_id" => CertificationLogTest::EVENT_ID,
                "success" => true,
                "approved_from_date" => $approved_from_date,
                "approved_until_date" => $approved_until_date,
            ]
        );
        $certification_log->assertStatus(200);
        $this->assertTrue($certification_log["success"] == true);
        $this->assertTrue($certification_log["user_id"] == CertificationLogTest::USER_ID);
        $this->assertTrue($certification_log["event_id"] == CertificationLogTest::EVENT_ID);
        $this->assertTrue($certification_log["approved_from_date"] == $approved_from_date);
        $this->assertTrue($certification_log["approved_until_date"] == $approved_until_date);

        // Update that certificate
        $certification_log = $this->putJson(
            "api/certification-logs/".$certification_log["_id"],
            [
                "success" => false,
                // "approved_from_date" => $approved_until_date, // We reverse that?
                // "approved_until_date" => $approved_from_date, // We reverse that?
            ]
        );

        $this->assertTrue($certification_log["success"] == false);
        // $this->assertTrue($certification_log["approved_from_date"] == $approved_until_date);
        // $this->assertTrue($certification_log["approved_until_date"] == $approved_from_date);

        $response = $this->delete("api/certification-logs/".$certification_log["_id"]);
        $response->assertStatus(200);
    }
}
