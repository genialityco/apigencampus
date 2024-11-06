<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
// models
use App\Models\User;
use App\Models\Attendee;

class EmailTest extends TestCase
{
    public function test_set_user_email_in_lowercase()
    {
        // $email = 'Test@Test.com';
        // $result = strtolower($email);
        // $this->assertTrue($result === strtolower($email) ? true : false);
        $user = new User;
        $user->email = 'TEST@TEST.com';

        $this->assertEquals('test@test.com', $user->email);
    }
    public function test_set_email_attendee_in_lowercase()
    {
        $user = new Attendee;
        $user->email = 'TEST@TEST.com';

        $this->assertEquals('test@test.com', $user->email);
    }
}
