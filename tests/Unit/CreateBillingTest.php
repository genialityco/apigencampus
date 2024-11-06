<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\User;
use App\Event;

class CreateBillingTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function CreateBilling()
    {
        $url = 'api/billings';
        $token = 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImY0ZTc2NDk3ZGE3Y2ZhOWNjMDkwZDcwZTIyNDQ2YTc0YjVjNTBhYTkiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoZGV2IiwiYXVkIjoiZXZpdXNhdXRoZGV2IiwiYXV0aF90aW1lIjoxNjU0MDA5MTc1LCJ1c2VyX2lkIjoiZVJDME9mZkdTZFBuRm1KM0RVbFNuN2xwc1ExMiIsInN1YiI6ImVSQzBPZmZHU2RQbkZtSjNEVWxTbjdscHNRMTIiLCJpYXQiOjE2NTQwMDkxNzUsImV4cCI6MTY1NDAxMjc3NSwiZW1haWwiOiJ0ZXN0X2FuZHJlc0Bldml1cy5jbyIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJlbWFpbCI6WyJ0ZXN0X2FuZHJlc0Bldml1cy5jbyJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.RvirUm0bBTvjuDkC8ys_pw1oPet9qR8zPufutH30etFHZGi2Fx5W336cV0eJB3dlPz0ydsyGvh0eTeS18cdI2KVi4k2ynoENqDcxyKuiWcGiLfRTPQkSFk-Qy39jlE-_ISho-Qc-tuZ7PFGcVPO8MEaVbv5gB8VRRtpr5rpPR_PFUoBeuPgOg-_Fq5CVe6G9xzv2BTkE44dKtST-17WZa2ZPOuyyhN0ScDLeJbTQW6jufD9dydgn_xR9AW77lykyrSezyH-RAdzRM9S5B0hsAP7Asi_RqVML2TU866VJ3gMLBP9RpKX4VX5kUiBScZzqej-FGcsGAuWNgyhaZl1mMw';
        $response = 
            $this->withoutMiddleware()
            //$this->withHeader('query', 'token' . $token)
            ->postJson($url, [
                "user_id"=> "62435cc584d932416c626519",
	            "plan_id"=> "62864ad118aa6b4b0f5820a2",
	            "billing"=> [
		            "save"=> false,
		            "reference_wompi"=> "asdads",
		            "reference_evius"=> "asdsad",
		            "payment_method"=> [
			            "method_name"=> "TARJETA DEBITO",
			            "type"=> "CARD",
			            "brand"=> "VISA",
			            "last_four"=> "4242",
			            "card_holder"=> "Cristian",
			            "exp_month"=> "08",
			            "exp_year"=> "22",
			            "id?"=> 27069,
			            "status?"=> "ACTIVE",
			            "address"=> [
				            "full_name"=> "Universidad Autonoma Del Caribe",
				            "identification"=> [
				            	"type=>"=> "EMPRESA || PERSONA",
				            	"value"=> "asdsda"
				            ],
				            "prefix"=> "57",
				            "phone_number"=> "3205627719",
				            "email"=> "asdsd",
				            "country"=> "CO",
				            "city"=> "BARRANQUILLA - ATLÁNTICO",
				            "address_line_1"=> "Principal",
				            "address_line_2"=> "Principal",
				            "region"=> "44444",
				            "postal_code"=> "08001"
                        ]
		            ],
		            "base_value"=> 154665,
		            "tax"=> 0.19,
		            "total"=> 22323,
		            "total_discount"=> 54662,
		            "details"=> [[
			        	"plan"=> [
			        		"price"=> 399,
			        		"amount"=> 1
			        	],
			        	"users"=> [
			        		"price"=> 2,
			        		"amount"=> 0
                        ]
                    ]],
		            "coupon_id"=> "asdsada",
		            "subscription_type"=> "MONTHLY",
		            "currency"=> "USD",
		            "action"=> "RENEWAL",
		            "status"=> "PENDING"
                ]
            ]);
        $response->assertStatus(201);
    }
}
