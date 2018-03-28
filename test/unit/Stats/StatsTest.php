<?php

namespace SendGridPhp\Tests\Stats;

use SendGridPhp\Tests\BaseTestClass;

class StatsTest extends BaseTestClass
{
    public function testStatsGetMethod()
    {
        $query_params = json_decode('{"aggregated_by": "day", "limit": 1, "start_date": "2016-01-01", "end_date": "2016-04-01", "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
