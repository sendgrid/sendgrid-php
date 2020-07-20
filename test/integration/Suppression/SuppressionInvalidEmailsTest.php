<?php

namespace SendGrid\Tests\Integration\Suppression;

use SendGrid\Tests\BaseTestClass;

class SuppressionInvalidEmailsTest extends BaseTestClass
{
    public function testSuppressionInvalidEmailsGetMethod()
    {
        $query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->suppression()->invalid_emails()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSuppressionInvalidEmailsDeleteMethod()
    {
        $request_body = json_decode('{
  "delete_all": false,
  "emails": [
    "example1@example.com",
    "example2@example.com"
  ]
}');
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->suppression()->invalid_emails()->delete($request_body, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testSuppressionInvalidEmailsEmailGetMethod()
    {
        $email = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->suppression()->invalid_emails()->_($email)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSuppressionBouncesEmailDeleteMethod()
    {
        $email = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->suppression()->invalid_emails()->_($email)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
