<?php

namespace SendGrid\Tests\Integration\Mail;

use SendGrid\Tests\BaseTestClass;

class MailBatchTest extends BaseTestClass
{
    public function testMailBatchPostMethod()
    {
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->mail()->batch()->post(null, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testMailBatchIdGetMethod()
    {
        $batch_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail()->batch()->_($batch_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
