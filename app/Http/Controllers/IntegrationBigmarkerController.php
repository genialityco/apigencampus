<?php

namespace App\Http\Controllers;

use App\Event;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

/**
 * @resource Event
 */
class IntegrationBigmarkerController extends Controller
{
    public function conferencesenter(Request $request)
    {
        try {

            $data = $request->json()->all();

            $url = "https://www.bigmarker.com/api/v1/conferences/enter";
            //$data["details"] = ["referenceCode" => $order_reference];
            $client = new Client();
            $response = $client->request('POST', $url, [
                'body' => json_encode($data),
                'headers' => ['API-KEY' => '7b8927965a0dc2b63f85'],
            ]);
            $response = $response->getBody()->getContents();
            return $response;

        } catch (\Exception $e) {

            $resp = $e->getResponse()->getBody()->getContents();
            return response($resp, 400);

        }

        //   let data = {
        //     id: "23a1ae7fc1af",
        //     attendee_name: displayName,
        //     attendee_email: email,
        //     exit_uri: config('app.front_url').""
        //   };

    }
}