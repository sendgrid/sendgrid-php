<?php

namespace SendGrid\Tests\Integration\Suppression;

use SendGrid\Tests\BaseTestClass;

class SuppressionBlocksTest extends BaseTestClass
{
    public function testSuppressionBlocksGetMethod()
    {
        $query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->suppression()->blocks()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSuppressionBlocksDeleteMethod()
    {
        $request_body = json_decode('{
  "delete_all": false,
  "emails": [
    "example1@example.com",
    "example2@example.com"
  ]
}');
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->suppression()->blocks()->delete($request_body, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testSuppressionBlocksEmailGetMethod()
    {
        $email = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->suppression()->blocks()->_($email)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSuppressionBlocksEmailDeleteMethod()
    {
        $email = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->suppression()->blocks()->_($email)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
