<?php

namespace SendGrid\Tests\Subusers;

use SendGrid\Tests\BaseTestClass;

class SubUsersTest extends BaseTestClass
{
    public function testSubUsersGetMethod()
    {
        $query_params = json_decode('{"username": "test_string", "limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersPostMethod()
    {
        $request_body = json_decode('{
  "email": "John@example.com",
  "ips": [
    "1.1.1.1",
    "2.2.2.2"
  ],
  "password": "johns_password",
  "username": "John@example.com"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->post($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersReputationGetMethod()
    {
        $query_params = json_decode('{"usernames": "test_string"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->reputations()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersStatsGetMethod()
    {
        $query_params = json_decode('{"end_date": "2016-04-01", "aggregated_by": "day", "limit": 1, "offset": 1, "start_date": "2016-01-01", "subusers": "test_string"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersStatsMonthlyGetMethod()
    {
        $query_params = json_decode('{"subuser": "test_string", "limit": 1, "sort_by_metric": "test_string", "offset": 1, "date": "test_string", "sort_by_direction": "asc"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->stats()->monthly()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersStatsSumsGetMethod()
    {
        $query_params = json_decode('{"end_date": "2016-04-01", "aggregated_by": "day", "limit": 1, "sort_by_metric": "test_string", "offset": 1, "start_date": "2016-01-01", "sort_by_direction": "asc"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->stats()->sums()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersNamePatchMethod()
    {
        $request_body = json_decode('{
  "disabled": false
}');
        $subuser_name = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->subusers()->_($subuser_name)->patch($request_body, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testSubUsersNameDeleteMethod()
    {
        $subuser_name = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->subusers()->_($subuser_name)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testSubUsersNameIpsPutMethod()
    {
        $request_body = json_decode('[
  "127.0.0.1"
]');
        $subuser_name = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->_($subuser_name)->ips()->put($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersNameMonitorPutMethod()
    {
        $request_body = json_decode('{
  "email": "example@example.com",
  "frequency": 500
}');
        $subuser_name = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->_($subuser_name)->monitor()->put(
            $request_body,
            null,
            $request_headers
        );
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersNameMonitorPostMethod()
    {
        $request_body = json_decode('{
  "email": "example@example.com",
  "frequency": 50000
}');
        $subuser_name = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->_($subuser_name)->monitor()->post(
            $request_body,
            null,
            $request_headers
        );
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersNameMonitorGetMethod()
    {
        $subuser_name = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->_($subuser_name)->monitor()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testSubUsersNameMonitorDeleteMethod()
    {
        $subuser_name = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->subusers()->_($subuser_name)->monitor()->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testSubUsersNameStatsMonthlyGetMethod()
    {
        $query_params = json_decode('{"date": "test_string", "sort_by_direction": "asc", "limit": 1, "sort_by_metric": "test_string", "offset": 1}');
        $subuser_name = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->subusers()->_($subuser_name)->stats()->monthly()->get(
            null,
            $query_params,
            $request_headers
        );
        $this->assertEquals(200, $response->statusCode());
    }
}
