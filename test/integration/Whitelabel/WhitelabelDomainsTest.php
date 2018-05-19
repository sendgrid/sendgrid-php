<?php

namespace SendGrid\Tests\Whitelabel;

use SendGrid\Tests\BaseTestClass;

class WhitelabelDomainsTest extends BaseTestClass
{
    public function testWhitelabelDomainsPostMethod()
    {
        $request_body = json_decode('{
  "automatic_security": false,
  "custom_spf": true,
  "default": true,
  "domain": "example.com",
  "ips": [
    "192.168.1.1",
    "192.168.1.2"
  ],
  "subdomain": "news",
  "username": "john@example.com"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->whitelabel()->domains()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testWhitelabelDomainsGetMethod()
    {
        $query_params = json_decode('{"username": "test_string", "domain": "test_string", "exclude_subusers": "true", "limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->domains()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelDomainsDefaultGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->domains()->default()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelDomainsSubUserGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->domains()->subuser()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelDomainsSubUserDeleteMethod()
    {
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->whitelabel()->domains()->subuser()->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testWhitelabelDomainsIdPatchMethod()
    {
        $request_body = json_decode('{
  "custom_spf": true,
  "default": false
}');
        $domain_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->domains()->_($domain_id)->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelDomainsIdGetMethod()
    {
        $domain_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->domains()->_($domain_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelDomainsIdDeleteMethod()
    {
        $domain_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->whitelabel()->domains()->_($domain_id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testWhitelabelDomainsIdSubUserPostMethod()
    {
        $request_body = json_decode('{
  "username": "jane@example.com"
}');
        $domain_id = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->whitelabel()->domains()->_($domain_id)->subuser()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testWhitelabelDomainsIdIpsPostMethod()
    {
        $request_body = json_decode('{
  "ip": "192.168.0.1"
}');
        $id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->domains()->_($id)->ips()->post($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelDomainsIdIpsDeleteMethod()
    {
        $id = "test_url_param";
        $ip = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->domains()->_($id)->ips()->_($ip)->delete(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testWhitelabelDomainsIdValidatePostMethod()
    {
        $id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->whitelabel()->domains()->_($id)->validate()->post(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
