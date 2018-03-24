<?php

namespace SendGridPhp\Tests\Mail;

use SendGridPhp\Tests\BaseTestClass;

class MailSettingsTest extends BaseTestClass
{
    public function testMailSettingsGetMethod()
    {
        $query_params = json_decode('{"limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsAddressWhitelistPatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true,
  "list": [
    "email1@example.com",
    "example.com"
  ]
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->address_whitelist()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsAddressWhitelistGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->address_whitelist()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsBccPatchMethod()
    {
        $request_body = json_decode('{
  "email": "email@example.com",
  "enabled": false
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->bcc()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsBccGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->bcc()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsBouncePurgePatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true,
  "hard_bounces": 5,
  "soft_bounces": 5
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->bounce_purge()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsBouncePurgeGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->bounce_purge()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsFooterPatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true,
  "html_content": "...",
  "plain_content": "..."
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->footer()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsFooterGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->footer()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsForwardBouncePatchMethod()
    {
        $request_body = json_decode('{
  "email": "example@example.com",
  "enabled": true
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->forward_bounce()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsForwardBounceGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->forward_bounce()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsForwardSpamPatchMethod()
    {
        $request_body = json_decode('{
  "email": "",
  "enabled": false
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->forward_spam()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsForwardSpamGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->forward_spam()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsPlainContentPatchMethod()
    {
        $request_body = json_decode('{
  "enabled": false
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->plain_content()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsPlainContentGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->plain_content()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsSpamCheckPatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true,
  "max_score": 5,
  "url": "url"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->spam_check()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsSpamCheckGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->spam_check()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsTemplatePatchMethod()
    {
        $request_body = json_decode('{
  "enabled": true,
  "html_content": "<% body %>"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->template()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testMailSettingsTemplateGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->mail_settings()->template()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
