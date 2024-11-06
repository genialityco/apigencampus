<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolesTest extends TestCase
{   
    const EMAIL = 'geraldine.garcia+2@mocionsoft.com';
    const EVENT_ID = '6222740c8160210bd90aaf8d';
    const NAMES = 'TEST';
    const PICTURE = 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y';
    const PASSWORD = '123456';     
    const TOKEN = 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjJkYzBlNmRmOTgyN2EwMjA2MWU4MmY0NWI0ODQwMGQwZDViMjgyYzAiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoIiwiYXVkIjoiZXZpdXNhdXRoIiwiYXV0aF90aW1lIjoxNjQ2NzQ3NjYzLCJ1c2VyX2lkIjoiUmRFUTdTaWRGaWNCT09ITUZnS0lTUVozR3NyMiIsInN1YiI6IlJkRVE3U2lkRmljQk9PSE1GZ0tJU1FaM0dzcjIiLCJpYXQiOjE2NDY4NTYxNTYsImV4cCI6MTY0Njg1OTc1NiwiZW1haWwiOiJnZXJhbGRpbmUuZ2FyY2lhQG1vY2lvbnNvZnQuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImZpcmViYXNlIjp7ImlkZW50aXRpZXMiOnsiZW1haWwiOlsiZ2VyYWxkaW5lLmdhcmNpYUBtb2Npb25zb2Z0LmNvbSJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.NebwDEPHOJ5xBEFXg4Nr6LLhafM8F5dDnAOt2Tjlf1bdX-aap2mqdQZDxCwvK8wrhfZlrfAPCIfyyqYSkt6mZrQIavqjQ_Le0UPrj0O0047MfY1QgmPG4ZMLNtFqDPWyP6YkPV8Hbn4_SQ0bU71jMNAErKe7dFpz47VZzIlWYtm9mzFYK3qj4alODrsn6tWnu5UmoDqmnpFelUWK6KFSifbQgg5LjTso0hYIodh5ZqALXGksvQD_mZSd2BUKp-Sumf7rQTF4tvgyDRX3m9RRteuUwb_kh1NmdoRn_Mf-Mkq09FJx6vkwgOg4eynWKM9GSvLUdadZcnL5lXn_2MRg1g';
    const USER_ID = "6228a01bd979f142d53288b7";


    public function get($uri, array $parameters = [], array $headers = [])
    {
        
        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();

        return $this->call('GET', $uri, $parameters, $cookies, [], $server);
    }
    
    /**
     * @group roles
     */
    public function testRolesIndex()
    {           
        
        $response = $this->get('api/events/' . self::EVENT_ID . '/rolevents',
                        ['token' => 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjJkYzBlNmRmOTgyN2EwMjA2MWU4MmY0NWI0ODQwMGQwZDViMjgyYzAiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoIiwiYXVkIjoiZXZpdXNhdXRoIiwiYXV0aF90aW1lIjoxNjQ2NzQ3NjYzLCJ1c2VyX2lkIjoiUmRFUTdTaWRGaWNCT09ITUZnS0lTUVozR3NyMiIsInN1YiI6IlJkRVE3U2lkRmljQk9PSE1GZ0tJU1FaM0dzcjIiLCJpYXQiOjE2NDY4NTYxNTYsImV4cCI6MTY0Njg1OTc1NiwiZW1haWwiOiJnZXJhbGRpbmUuZ2FyY2lhQG1vY2lvbnNvZnQuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImZpcmViYXNlIjp7ImlkZW50aXRpZXMiOnsiZW1haWwiOlsiZ2VyYWxkaW5lLmdhcmNpYUBtb2Npb25zb2Z0LmNvbSJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.NebwDEPHOJ5xBEFXg4Nr6LLhafM8F5dDnAOt2Tjlf1bdX-aap2mqdQZDxCwvK8wrhfZlrfAPCIfyyqYSkt6mZrQIavqjQ_Le0UPrj0O0047MfY1QgmPG4ZMLNtFqDPWyP6YkPV8Hbn4_SQ0bU71jMNAErKe7dFpz47VZzIlWYtm9mzFYK3qj4alODrsn6tWnu5UmoDqmnpFelUWK6KFSifbQgg5LjTso0hYIodh5ZqALXGksvQD_mZSd2BUKp-Sumf7rQTF4tvgyDRX3m9RRteuUwb_kh1NmdoRn_Mf-Mkq09FJx6vkwgOg4eynWKM9GSvLUdadZcnL5lXn_2MRg1g']
                    );
        $response->assertStatus(200);
    }

}