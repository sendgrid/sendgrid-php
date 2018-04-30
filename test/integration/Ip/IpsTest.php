<?php

namespace SendGrid\Tests\Ip;

use SendGrid\Tests\BaseTestClass;

class IpsTest extends BaseTestClass
{
    public function testIpsGetMethod()
    {
        $query_params = json_decode('{"subuser": "test_string", "ip": "test_string", "limit": 1, "exclude_whitelabels": "true", "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpsAssignedGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->assigned()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpsIpAddressGetMethod()
    {
        $ip_address = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->_($ip_address)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
