<?php

namespace SendGrid\Tests\Settings;

use SendGrid\Tests\BaseTestClass;

class PartnerSettingsTest extends BaseTestClass
{
    public function testPartnerSettingsGetMethod()
    {
        $query_params = json_decode('{"limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->partner_settings()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testPartnerSettingsNewRelicPatchMethod()
    {
        $request_body = json_decode('{
  "enable_subuser_statistics": true,
  "enabled": true,
  "license_key": ""
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->partner_settings()->new_relic()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testPartnerSettingsNewRelicGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->partner_settings()->new_relic()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
