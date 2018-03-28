<?php

namespace SendGridPhp\Tests\Ip;

use SendGridPhp\Tests\BaseTestClass;

class IpPoolsTest extends BaseTestClass
{
    public function testIpPoolsPostMethod()
    {
        $request_body = json_decode('{
  "name": "marketing"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->pools()->post($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpPoolsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->pools()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpPoolsPoolNamePutMethod()
    {
        $request_body = json_decode('{
  "name": "new_pool_name"
}');
        $pool_name = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->pools()->_($pool_name)->put($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpPoolsPoolNameGetMethod()
    {
        $pool_name = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->ips()->pools()->_($pool_name)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testIpPoolsPoolNameDeleteMethod()
    {
        $pool_name = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->ips()->pools()->_($pool_name)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testIpPoolsPoolNameIpsPostMethod()
    {
        $request_body = json_decode('{
  "ip": "0.0.0.0"
}');
        $pool_name = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->ips()->pools()->_($pool_name)->ips()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testIpPoolsPoolNameIpsIdDeleteMethod()
    {
        $pool_name = "test_url_param";
        $ip = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->ips()->pools()->_($pool_name)->ips()->_($ip)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
