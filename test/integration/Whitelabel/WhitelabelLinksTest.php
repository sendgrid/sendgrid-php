<?php

namespace SendGrid\Tests\Whitelabel;

use SendGrid\Tests\BaseTestClass;

class WhitelabelLinksTest extends BaseTestClass
{
    public function testWhitelabelLinksPostMethod()
    {
        $request_body = json_decode('{
  "default": true,
  "domain": "example.com",
  "subdomain": "mail"
}');
        $query_params = json_decode('{"limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->whitelabel()->links()->post($request_body, $query_params, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testWhitelabelLinksGetMethod()
    {
        $query_params = json_decode('{"limit": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->links()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelLinksDefaultGetMethod()
    {
        $query_params = json_decode('{"domain": "test_string"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->links()->default()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelLinksSubUserGetMethod()
    {
        $query_params = json_decode('{"username": "test_string"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->links()->subuser()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelLinksSubUserDeleteMethod()
    {
        $query_params = json_decode('{"username": "test_string"}');
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->whitelabel()->links()->subuser()->delete(null, $query_params, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testWhitelabelLinksIdPatchMethod()
    {
        $request_body = json_decode('{
  "default": true
}');
        $id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->links()->_($id)->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelLinksIdGetMethod()
    {
        $id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->links()->_($id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelLinksIdDeleteMethod()
    {
        $id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->whitelabel()->links()->_($id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testWhitelabelLinksIdValidatePostMethod()
    {
        $id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->links()->_($id)->validate()->post(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelLinksIdSubUserPostMethod()
    {
        $request_body = json_decode('{
  "username": "jane@example.com"
}');
        $link_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->links()->_($link_id)->subuser()->post($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
