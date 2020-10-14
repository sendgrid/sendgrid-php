<?php

namespace SendGrid\Tests\Integration\Users;

use SendGrid\Tests\BaseTestClass;

class UserTest extends BaseTestClass
{
    public function testUserMethod()
    {
        $query_params = json_decode('{"aggregated_by": "day", "limit": 1, "start_date": "2016-01-01", "end_date": "2016-04-01", "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserAccountGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->account()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserCreditsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->credits()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserEmailPutMethod()
    {
        $request_body = json_decode('{
  "email": "example@example.com"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->email()->put($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserEmailGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->email()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserPasswordPutMethod()
    {
        $request_body = json_decode('{
  "new_password": "new_password",
  "old_password": "old_password"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->password()->put($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserProfilePatchMethod()
    {
        $request_body = json_decode('{
  "city": "Orange",
  "first_name": "Example",
  "last_name": "User"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->profile()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserProfileGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->profile()->get(null, null, $request_headers);
        $this->assertEquals($response->statusCode(), 200);
    }

    public function testUserScheduledSendsPostMethod()
    {
        $request_body = json_decode('{
  "batch_id": "YOUR_BATCH_ID",
  "status": "pause"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->user()->scheduled_sends()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testUserScheduledSendsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->scheduled_sends()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserScheduledSendsBatchIdPatchMethod()
    {
        $request_body = json_decode('{
  "status": "pause"
}');
        $batch_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->user()->scheduled_sends()->_($batch_id)->patch(
            $request_body,
            null,
            $request_headers
        );
        $this->assertEquals(204, $response->statusCode());
    }

    public function testUserScheduledSendsBatchIdGetMethod()
    {
        $batch_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->scheduled_sends()->_($batch_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserScheduledSendsBatchIdDeleteMethod()
    {
        $batch_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->user()->scheduled_sends()->_($batch_id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testUserSettingsEnforcedTlsPatchMethod()
    {
        $request_body = json_decode('{
  "require_tls": true,
  "require_valid_cert": false
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->settings()->enforced_tls()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserSettingsEnforcedTlsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->settings()->enforced_tls()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserUsernamePutMethod()
    {
        $request_body = json_decode('{
  "username": "test_username"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->username()->put($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserUsernameGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->username()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserWebhooksEventSettingsPatchMethod()
    {
        $request_body = json_decode('{
  "bounce": true,
  "click": true,
  "deferred": true,
  "delivered": true,
  "dropped": true,
  "enabled": true,
  "group_resubscribe": true,
  "group_unsubscribe": true,
  "open": true,
  "processed": true,
  "spam_report": true,
  "unsubscribe": true,
  "url": "url"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->webhooks()->event()->settings()->patch(
            $request_body,
            null,
            $request_headers
        );
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserWebhooksEventSettingsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->webhooks()->event()->settings()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserWebhooksEventTestPostMethod()
    {
        $request_body = json_decode('{
  "url": "url"
}');
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->user()->webhooks()->event()->test()->post($request_body, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testUserWebhooksParseSettingsPostMethod()
    {
        $request_body = json_decode('{
  "hostname": "myhostname.com",
  "send_raw": false,
  "spam_check": true,
  "url": "http://email.myhosthame.com"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->user()->webhooks()->parse()->settings()->post(
            $request_body,
            null,
            $request_headers
        );
        $this->assertEquals(201, $response->statusCode());
    }

    public function testUserWebhooksParseSettingsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->webhooks()->parse()->settings()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserWebhooksParseHostnamePatchMethod()
    {
        $request_body = json_decode('{
  "send_raw": true,
  "spam_check": false,
  "url": "http://newdomain.com/parse"
}');
        $hostname = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->webhooks()->parse()->settings()->_($hostname)
            ->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserWebhooksParseHostnameGetMethod()
    {
        $hostname = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->webhooks()->parse()->settings()->_($hostname)->get(
            null,
            null,
            $request_headers
        );
        $this->assertEquals(200, $response->statusCode());
    }

    public function testUserWebhooksParseHostnameDeleteMethod()
    {
        $hostname = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->user()->webhooks()->parse()->settings()->_($hostname)->delete(
            null,
            null,
            $request_headers
        );
        $this->assertEquals(204, $response->statusCode());
    }

    public function testUserWebhooksParseStatsGetMethod()
    {
        $query_params = json_decode('{"aggregated_by": "day", "limit": "test_string", "start_date": "2016-01-01", "end_date": "2016-04-01", "offset": "test_string"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->user()->webhooks()->parse()->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
