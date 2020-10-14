<?php

namespace SendGrid\Tests\Integration\Templates;

use SendGrid\Tests\BaseTestClass;

class TemplatesTest extends BaseTestClass
{
    public function testTemplatesPostMethod()
    {
        $request_body = json_decode('{
  "name": "example_name"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->templates()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testTemplatesGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->templates()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTemplatesIdPatchMethod()
    {
        $request_body = json_decode('{
  "name": "new_example_name"
}');
        $template_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->templates()->_($template_id)->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTemplatesIdGetMethod()
    {
        $template_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->templates()->_($template_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTemplatesIdDeleteMethod()
    {
        $template_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->templates()->_($template_id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testTemplatesIdVersionsPostMethod()
    {
        $request_body = json_decode('{
  "active": 1,
  "html_content": "<%body%>",
  "name": "example_version_name",
  "plain_content": "<%body%>",
  "subject": "<%subject%>",
  "template_id": "ddb96bbc-9b92-425e-8979-99464621b543"
}');
        $template_id = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->templates()->_($template_id)->versions()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testTemplatesIdVersionsIdPatchMethod()
    {
        $request_body = json_decode('{
  "active": 1,
  "html_content": "<%body%>",
  "name": "updated_example_name",
  "plain_content": "<%body%>",
  "subject": "<%subject%>"
}');
        $template_id = "test_url_param";
        $version_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->templates()->_($template_id)->versions()->_($version_id)
                                     ->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTemplatesIdVersionsIdGetMethod()
    {
        $template_id = "test_url_param";
        $version_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->templates()->_($template_id)->versions()->_($version_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testTemplatesIdVersionsIdDeleteMethod()
    {
        $template_id = "test_url_param";
        $version_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->templates()->_($template_id)->versions()->_($version_id)
                                     ->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testTemplatesIdVersionsIdActivatePostMethod()
    {
        $template_id = "test_url_param";
        $version_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->templates()->_($template_id)->versions()->_($version_id)->activate()
                                     ->post(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
