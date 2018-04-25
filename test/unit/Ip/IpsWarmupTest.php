<?php

namespace SendGrid\Tests\Ip;

use SendGrid\Tests\BaseTestClass;

class IpsWarmupTest extends BaseTestClass
{
    public function testIpsWarmupGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->warmup()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpsWarmupPostMethod()
    {
        $request_body = json_decode('{
  "ip": "0.0.0.0"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->warmup()->post($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpsWarmupIpAddressGetMethod()
    {
        $ip_address = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->warmup()->_($ip_address)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpsWarmupIpAddressDeleteMethod()
    {
        $ip_address = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->ips()->warmup()->_($ip_address)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
