<?php

namespace SendGrid\Tests\Integration\Suppression;

use SendGrid\Tests\BaseTestClass;

class SuppressionBouncesTest extends BaseTestClass
{
    public function testSuppressionBouncesGetMethod()
    {
        $query_params = json_decode('{"start_time": 1, "end_time": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->suppression()->bounces()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSuppressionBouncesDeleteMethod()
    {
        $request_body = json_decode('{
  "delete_all": true,
  "emails": [
    "example@example.com",
    "example2@example.com"
  ]
}');
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->suppression()->bounces()->delete($request_body, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testSuppressionBouncesEmailGetMethod()
    {
        $email = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->suppression()->bounces()->_($email)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSuppressionBouncesEmailDeleteMethod()
    {
        $query_params = json_decode('{"email_address": "example@example.com"}');
        $email = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->suppression()->bounces()->_($email)->delete(null, $query_params, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
