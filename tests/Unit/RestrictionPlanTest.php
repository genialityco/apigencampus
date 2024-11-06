<?php

namespace Tests\Unit;

use Tests\TestCase;

class RestrictionPlanTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_default_free_plan()
    {
        // create user without sending plan_id
        $userWithoutPlan = $this->postJson('api/users',
            [
                'names' => 'MR Vikingo',
                'email' => 'vikingo@mocionsoft.com',
                'password' => 'Vikingo 123',
            ]);
        // validate user plan
        $this->assertEquals('6285536ce040156b63d517e5', $userWithoutPlan['plan_id']); // id Free plan

        $this
            ->withoutMiddleware()
            ->delete("api/users/${userWithoutPlan['_id']}");

        // create user with plan_id
        $userWithPlan = $this->postJson('api/users',
        [
            'names' => 'MR Vikingo',
            'email' => 'vikingo@mocionsoft.com',
            'password' => 'Vikingo 123',
            'plan_id' => '62864ad118aa6b4b0f5820a2'
        ]);
        // validate user plan
        $this->assertEquals('62864ad118aa6b4b0f5820a2', $userWithPlan['plan_id']); // id Basic plan
    }
}
