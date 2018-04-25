<?php

namespace SendGrid\Tests\Asm;

use SendGrid\Tests\BaseTestClass;

class AsmGroupsTest extends BaseTestClass
{
    public function testAsmGroupsPostMethod()
    {
        $request_body = json_decode('{
  "description": "Suggestions for products our users might like.",
  "is_default": true,
  "name": "Product Suggestions"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->asm()->groups()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testAsmGroupsGetMethod()
    {
        $query_params = json_decode('{"id": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->asm()->groups()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAsmGroupsIdPatchMethod()
    {
        $request_body = json_decode('{
  "description": "Suggestions for items our users might like.",
  "id": 103,
  "name": "Item Suggestions"
}');
        $group_id = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->asm()->groups()->_($group_id)->patch($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testAsmGroupsIdGetMethod()
    {
        $group_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->asm()->groups()->_($group_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAsmGroupsIdDeleteMethod()
    {
        $group_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->asm()->groups()->_($group_id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testAsmGroupsIdSuppressionPostMethod()
    {
        $request_body = json_decode('{
  "recipient_emails": [
    "test1@example.com",
    "test2@example.com"
  ]
}');
        $group_id = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->asm()->groups()->_($group_id)->suppressions()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testAsmGroupsIdSuppressionGetMethod()
    {
        $group_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->asm()->groups()->_($group_id)->suppressions()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAsmGroupsIdSuppressionSearchPostMethod()
    {
        $request_body = json_decode('{
  "recipient_emails": [
    "exists1@example.com",
    "exists2@example.com",
    "doesnotexists@example.com"
  ]
}');
        $group_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->asm()->groups()->_($group_id)->suppressions()->search()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testAsmGroupsIdSuppressionEmailDeleteMethod()
    {
        $group_id = "test_url_param";
        $email = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->asm()->groups()->_($group_id)->suppressions()->_($email)
                                     ->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
