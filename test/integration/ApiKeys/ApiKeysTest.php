<?php

namespace SendGrid\Tests\Integration\ApiKeys;

use SendGrid\Tests\BaseTestClass;

class ApiKeysTest extends BaseTestClass
{
    public function testApiKeysPostMethod()
    {
        $request_body = json_decode('{
  "name": "My API Key",
  "sample": "data",
  "scopes": [
    "mail.send",
    "alerts.create",
    "alerts.read"
  ]
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->api_keys()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testApiKeysGetMethod()
    {
        $query_params = json_decode('{"limit": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->api_keys()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testApiKeysIdPutMethod()
    {
        $request_body = json_decode('{
  "name": "A New Hope",
  "scopes": [
    "user.profile.read",
    "user.profile.update"
  ]
}');
        $api_key_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->api_keys()->_($api_key_id)->put($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testApiKeysIdPatchMethod()
    {
        $request_body = json_decode('{
  "name": "A New Hope"
}');
        $api_key_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->api_keys()->_($api_key_id)->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testApiKeysIdGetMethod()
    {
        $api_key_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->api_keys()->_($api_key_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testApiKeysIdDeleteMethod()
    {
        $api_key_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->api_keys()->_($api_key_id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
