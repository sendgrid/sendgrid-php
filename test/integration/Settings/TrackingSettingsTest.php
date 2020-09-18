<?php

namespace SendGrid\Tests\Integration\Settings;

use SendGrid\Tests\BaseTestClass;

class TrackingSettingsTest extends BaseTestClass
{
    public function testTrackingSettingsGetMethod()
    {
        $query_params = json_decode('{"limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTrackingSettingsClickPatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->click()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTrackingSettingsClickGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->click()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTrackingSettingsGoogleAnalyticsPatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true,
  "utm_campaign": "website",
  "utm_content": "",
  "utm_medium": "email",
  "utm_source": "sendgrid.com",
  "utm_term": ""
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->google_analytics()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTrackingSettingsGoogleAnalyticsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->google_analytics()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTrackingSettingsOpenPatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->open()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTrackingSettingsOpenGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->open()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTrackingSettingsSubscriptionPatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true,
  "html_content": "html content",
  "landing": "landing page html",
  "plain_content": "text content",
  "replace": "replacement tag",
  "url": "url"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->subscription()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTrackingSettingsSubscriptionGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->tracking_settings()->subscription()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
