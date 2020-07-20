<?php

namespace SendGrid\Tests\Integration\Alerts;

use SendGrid\Tests\BaseTestClass;

class AlertsTest extends BaseTestClass
{
    public function testAlertsPostMethod()
    {
        $request_body = json_decode('{
  "email_to": "example@example.com",
  "frequency": "daily",
  "type": "stats_notification"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->alerts()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testAlertsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->alerts()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAlertsIdPatchMethod()
    {
        $request_body = json_decode('{
  "email_to": "example@example.com"
}');
        $alert_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->alerts()->_($alert_id)->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAlertsIdGetMethod()
    {
        $alert_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->alerts()->_($alert_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAlertsIdDeleteMethod()
    {
        $alert_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->alerts()->_($alert_id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
