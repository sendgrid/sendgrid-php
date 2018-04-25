<?php

namespace SendGrid\Tests\Categories;

use SendGrid\Tests\BaseTestClass;

class CategoriesTest extends BaseTestClass
{
    public function testCategoriesGetMethod()
    {
        $query_params = json_decode('{"category": "test_string", "limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->categories()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testCategoriesStatsGetMethod()
    {
        $query_params = json_decode('{"end_date": "2016-04-01", "aggregated_by": "day", "limit": 1, "offset": 1, "start_date": "2016-01-01", "categories": "test_string"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->categories()->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testCategoriesStatsSumsGetMethod()
    {
        $query_params = json_decode('{"end_date": "2016-04-01", "aggregated_by": "day", "limit": 1, "sort_by_metric": "test_string", "offset": 1, "start_date": "2016-01-01", "sort_by_direction": "asc"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->categories()->stats()->sums()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
