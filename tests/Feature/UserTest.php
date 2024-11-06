<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\withoutExceptionHandling;
use Mockery;

use Tests\TestCase;

class UserTest extends TestCase
{   
    private static $id;

    // public function __construct(){
    //     $this->withoutMiddleware();
    // }
    /**
     * @group users-crud
     * https://api.evius.co/docs/#store-create-new-user-and-send-confirmation-email
     */
    public function testUserStore()
    {   

        //Se quita la validación del middleware
        $this->withoutMiddleware();


        //Se llama factory para crear un usuario ficticio
        $user = factory(\App\Account::class)->make();       

        // $response = $this->get('api/users');
        $response = $this->postJson(
                        'api/users/' , 
                        [
                            'email' => $user->email,
                            'names' => $user->names,
                            'picture' => $user->picture,
                            'password' => $user->password,
            
                        ]
                    );  
                    
        //Capturar la data del response                     
        self::$id =  $response->getOriginalContent()['_id'];            
        $response->assertStatus(200);
    }

    
    /**
     * @depends testUserStore
     * @group users-crud
     * https://api.evius.co/docs/#show-view-a-specific-registered-user
     */
    public function testUserShow()
    {
        $response = $this->get("api/users/". self::$id);
        $response->assertStatus(200);
    }

    /**
     * @depends testUserStore
     * @group users-crud
     * https://api.evius.co/docs/#update-update-registered-user
     */
    public function testUserUpdate()
    {
        $this->withoutMiddleware();
        $this->withoutExceptionHandling();
        $response = $this->putJson(
             "api/users/". self::$id, 
            [
                'names' => 'name update',
            ]
        );
        $response->assertStatus(200);
    }

    /**
     * @depends testUserUpdate
     * @group users-crud
     * https://api.evius.co/docs/#update-update-registered-user
     */
    public function testUserDelete()
    {
        $this->withoutMiddleware();
        $response = $this->delete("api/users/". self::$id);
        $response->assertStatus(200);
    }


    //Métodos especiales fuera del crud

    /**
     * @group users-mail
     * @group mail
     * https://api.evius.co/docs/#getaccesslink-get-and-sent-link-acces-to-email-to-user
     */
    public function testAccessLinkMail(){
        
        $this->withoutExceptionHandling();

        $response = $this->postJson(
            "api/getloginlink/", 
           [
               'email' => getenv('EMAIL'),
           ]
       );
        $response->assertStatus(200);
    }


    /**
     * @group users-mail
     * @group mail
     * https://api.evius.co/docs/#changeuserpassword-send-to-email-to-user-whit-link-to-change-user-password
     */
    public function testChangeUserPassword(){
        
        $this->withoutExceptionHandling();

        $response = $this->putJson(
            "api/changeuserpassword/", 
           [
               'email' => getenv('EMAIL'),
               'hostName' =>  config('app.front_url')
           ]
       );
        $response->assertStatus(200);
    }

}
