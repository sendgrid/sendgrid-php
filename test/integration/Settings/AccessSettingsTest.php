<?php

namespace SendGrid\Tests\Integration\Settings;

use SendGrid\Tests\BaseTestClass;

class AccessSettingsTest extends BaseTestClass
{
    public function testAccessSettingsActivityGetMethod()
    {
        $query_params = [
            'limit' => 1
        ];
        $request_headers = ['X-Mock: 200'];
        $response = self::$sg->client->access_settings()->activity()->get(null, $query_params, $request_headers);

        $this->assertEquals(200, $response->statusCode());
    }

    public function testAccessSettingsWhitelistPostMethod()
    {
        $request_body = json_decode('{
  "ips": [
    {
      "ip": "192.168.1.1"
    },
    {
      "ip": "192.*.*.*"
    },
    {
      "ip": "192.168.1.3/32"
    }
  ]
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->access_settings()->whitelist()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testAccessSettingsWhitelistGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->access_settings()->whitelist()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAccessSettingsWhitelistDeleteMethod()
    {
        $request_body = json_decode('{
  "ids": [
    1,
    2,
    3
  ]
}');
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->access_settings()->whitelist()->delete($request_body, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testAccessSettingsWhitelistRuleIdGetMethod()
    {
        $rule_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->access_settings()->whitelist()->_($rule_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAccessSettingsWhitelistRuleIdDeleteMethod()
    {
        $rule_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->access_settings()->whitelist()->_($rule_id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
