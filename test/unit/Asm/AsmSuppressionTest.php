<?php

namespace SendGridPhp\Tests\Asm;

use SendGridPhp\Tests\BaseTestClass;

class AsmSuppressionTest extends BaseTestClass
{
    public function testAsmSuppressionGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->asm()->suppressions()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAsmSuppressionGlobalPostMethod()
    {
        $request_body = json_decode('{
  "recipient_emails": [
    "test1@example.com",
    "test2@example.com"
  ]
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->asm()->suppressions()->global()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testAsmSuppressionGlobalEmailGetMethod()
    {
        $email = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->asm()->suppressions()->global()->_($email)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAsmSuppressionGlobalEmailDeleteMethod()
    {
        $email = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->asm()->suppressions()->global()->_($email)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testAsmSuppressionEmailGetMethod()
    {
        $email = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->asm()->suppressions()->_($email)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
