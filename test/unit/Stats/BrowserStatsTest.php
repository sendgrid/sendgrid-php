<?php

namespace SendGrid\Tests\Stats;

use SendGrid\Tests\BaseTestClass;

class BrowserStatsTest extends BaseTestClass
{
    public function testBrowserStatsGetMethod()
    {
        $query_params = json_decode('{"end_date": "2016-04-01", "aggregated_by": "day", "browsers": "test_string", "limit": "test_string", "offset": "test_string", "start_date": "2016-01-01"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->browsers()->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
