<?php

namespace Tests\Feature\Http\Controllers;

use App\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * Se debe buscar la forma de obtener el token auth del usuario para usarlo en los tests
     */
    public function test_user_index()
    {
        $this
            ->get('api/users')
            ->assertStatus(200)
            ->assertExactJson(["data" => "Can't query all users of the platform maximun scope is by event, please query particular user by _id or findByEmail"]);
    }

    public function test_user_store()
    {
        // create user
        $this
            ->postJson('api/users',
            [
                'names' => 'MR Vikingo',
                'email' => 'vikingo@mocionsoft.com',
                'password' => 'Vikingo 123',
            ]);
        // validate that this user exists in db
        $this->assertDatabaseHas('users', ['email' => 'vikingo@mocionsoft.com']);
    }

    public function test_user_show()
    {
        $this
            ->get("api/users/62744691a0398817c511d892")
            ->assertStatus(200);
    }

    public function test_find_by_email()
    {
        $userByEmail = [["_id" => "62744691a0398817c511d892", "names"=> "MR Vikingo", "email"=> "vikingo@mocionsoft.com"]];
        $this
            ->get("api/users/findByEmail/vikingo@mocionsoft.com")
            ->assertExactJson($userByEmail)
            ->assertStatus(200);
    }

    public function test_user_update()
    {
        // $user = factory(Account::class)->create();
        $this
            ->putJson("api/users/62744691a0398817c511d892/?token=eyJhbGciOiJSUzI1NiIsImtpZCI6ImVmMzAxNjFhOWMyZGI3ODA5ZjQ1MTNiYjRlZDA4NzNmNDczMmY3MjEiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoZGV2IiwiYXVkIjoiZXZpdXNhdXRoZGV2IiwiYXV0aF90aW1lIjoxNjUxNzgxMjk5LCJ1c2VyX2lkIjoia1dCa2NkcU9oelE4eGtSOEtiYzA2Um1hWnEwMyIsInN1YiI6ImtXQmtjZHFPaHpROHhrUjhLYmMwNlJtYVpxMDMiLCJpYXQiOjE2NTE3ODEyOTksImV4cCI6MTY1MTc4NDg5OSwiZW1haWwiOiJ2aWtpbmdvQG1vY2lvbnNvZnQuY29tIiwiZW1haWxfdmVyaWZpZWQiOmZhbHNlLCJmaXJlYmFzZSI6eyJpZGVudGl0aWVzIjp7ImVtYWlsIjpbInZpa2luZ29AbW9jaW9uc29mdC5jb20iXX0sInNpZ25faW5fcHJvdmlkZXIiOiJwYXNzd29yZCJ9fQ.f4A292hazo1g1DvcThBv9sR2luMcXdDjDtoeXC8LNzPIyjIeAlciBYDWSo1g7fWxTyK8l8mFkk0uNOxW7Ttp42oCz0bpofnSZai56SRMXzgjXUq6PWBmpbc6HZ_insttfoZ5lGjR4luVqwPAav4mqqd3XjuUU8c0v26IvpiAGENSsCMlY441phT5MeSeC3VLPyBUTRKY-3UufTr8WoCtMmsm7HkL1QXekw-6VNQYmQSCuVkWV8b_G8VLwrDM8YEZOiv2p8lCjaiYCJRTXz5KEcWCD0Z484yQqQrA7z7KJmj5nKhApIdmnp0DM_0R_LcQXBUBK-FQCrRxvkAI-yQVcA&limit=20", ["names" => "New Name"])
            ->assertStatus(200);
    }

    public function test_user_delete()
    {
        $user = factory(Account::class)->create();
        $this
            ->delete("api/users/$user->_id")
            ->assertStatus(204);
        
        $this->assertDatabaseMissing('users', ['names' => $user->names]);
    }

    public function test_signInWithEmailAndPassword()
    {
        $this->postJson('api/users/signInWithEmailAndPassword', [
            'email' => 'vikingo@mocionsoft.com',
            'password' => ''
        ]);
    }
}
