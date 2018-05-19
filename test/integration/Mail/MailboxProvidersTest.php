<?php

namespace SendGrid\Tests\Mail;

use SendGrid\Tests\BaseTestClass;

class MailboxProvidersTest extends BaseTestClass
{
    public function testMailboxProvidersStatsGetMethod()
    {
        $query_params = json_decode('{"end_date": "2016-04-01", "mailbox_providers": "test_string", "aggregated_by": "day", "limit": 1, "offset": 1, "start_date": "2016-01-01"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mailbox_providers()
                                     ->stats()
                                     ->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
