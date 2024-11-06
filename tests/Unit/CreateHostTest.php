<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\User;
use App\Event;

class CreateHostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateHost()
    {
        $event = Event::findOrFail('628fdfd2811b1ca9f80a7793');
        $user = User::findOrFail($event->author_id);
        //dd("user", $user);
        $url = 'api/events/628fdfd2811b1ca9f80a7793/host';
        $token = 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImY0ZTc2NDk3ZGE3Y2ZhOWNjMDkwZDcwZTIyNDQ2YTc0YjVjNTBhYTkiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoZGV2IiwiYXVkIjoiZXZpdXNhdXRoZGV2IiwiYXV0aF90aW1lIjoxNjU0MDA5MTc1LCJ1c2VyX2lkIjoiZVJDME9mZkdTZFBuRm1KM0RVbFNuN2xwc1ExMiIsInN1YiI6ImVSQzBPZmZHU2RQbkZtSjNEVWxTbjdscHNRMTIiLCJpYXQiOjE2NTQwMDkxNzUsImV4cCI6MTY1NDAxMjc3NSwiZW1haWwiOiJ0ZXN0X2FuZHJlc0Bldml1cy5jbyIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJlbWFpbCI6WyJ0ZXN0X2FuZHJlc0Bldml1cy5jbyJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.RvirUm0bBTvjuDkC8ys_pw1oPet9qR8zPufutH30etFHZGi2Fx5W336cV0eJB3dlPz0ydsyGvh0eTeS18cdI2KVi4k2ynoENqDcxyKuiWcGiLfRTPQkSFk-Qy39jlE-_ISho-Qc-tuZ7PFGcVPO8MEaVbv5gB8VRRtpr5rpPR_PFUoBeuPgOg-_Fq5CVe6G9xzv2BTkE44dKtST-17WZa2ZPOuyyhN0ScDLeJbTQW6jufD9dydgn_xR9AW77lykyrSezyH-RAdzRM9S5B0hsAP7Asi_RqVML2TU866VJ3gMLBP9RpKX4VX5kUiBScZzqej-FGcsGAuWNgyhaZl1mMw';
        $response = 
            $this->withoutMiddleware()
            //$this->withHeader('query', 'token' . $token)
            ->postJson($url, [
                "name"=>"Test 2",
	            "image"=>null,
	            "description_activity"=>true,
	            "description"=>"<p>Este speaker es de prueba</p>",
	            "profession"=>"Ingeniero",
	            "published"=>true,
	            "order"=>0,
	            "index"=>0,
            ]);
        $response->assertStatus(401);
        //dd($response->original);
        //$response->assertStatus(201);
    }
}
