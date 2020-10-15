<?php

namespace SendGrid\Tests\Integration\SenderAuthentication;

use SendGrid\Tests\BaseTestClass;

class ReverseDNSTest extends BaseTestClass
{
    public function testWhitelabelIpsPostMethod()
    {
        $request_body = json_decode('{
  "domain": "example.com",
  "ip": "192.168.1.1",
  "subdomain": "email"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->whitelabel()->ips()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testWhitelabelIpsGetMethod()
    {
        $query_params = json_decode('{"ip": "test_string", "limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->ips()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelIpsIdGetMethod()
    {
        $id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->ips()->_($id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelIpsIdDeleteMethod()
    {
        $id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->whitelabel()->ips()->_($id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testWhitelabelIpsIdValidatePostMethod()
    {
        $id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->ips()->_($id)->validate()->post(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
