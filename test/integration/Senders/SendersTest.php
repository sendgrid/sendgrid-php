<?php

namespace SendGrid\Tests\Integration\Senders;

use SendGrid\Tests\BaseTestClass;

class SendersTest extends BaseTestClass
{
    public function testSendersPostMethod()
    {
        $request_body = json_decode('{
  "address": "123 Elm St.",
  "address_2": "Apt. 456",
  "city": "Denver",
  "country": "United States",
  "from": {
    "email": "from@example.com",
    "name": "Example INC"
  },
  "nickname": "My Sender ID",
  "reply_to": {
    "email": "replyto@example.com",
    "name": "Example INC"
  },
  "state": "Colorado",
  "zip": "80202"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->senders()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testSendersGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->senders()
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSendersIdPatchMethod()
    {
        $request_body = json_decode('{
  "address": "123 Elm St.",
  "address_2": "Apt. 456",
  "city": "Denver",
  "country": "United States",
  "from": {
    "email": "from@example.com",
    "name": "Example INC"
  },
  "nickname": "My Sender ID",
  "reply_to": {
    "email": "replyto@example.com",
    "name": "Example INC"
  },
  "state": "Colorado",
  "zip": "80202"
}');
        $sender_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->senders()
                                     ->_($sender_id)
                                     ->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSendersIdGetMethod()
    {
        $sender_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->senders()
                                     ->_($sender_id)
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSendersIdDeleteMethod()
    {
        $sender_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->senders()
                                     ->_($sender_id)
                                     ->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testSendersIdResendVerificationPostMethod()
    {
        $sender_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->senders()
                                     ->_($sender_id)
                                     ->resend_verification()
                                     ->post(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
