<?php

namespace SendGrid\Tests\Stats;

use SendGrid\Tests\BaseTestClass;

class GeoStatsTest extends BaseTestClass
{
    public function testGeoStatsGetMethod()
    {
        $query_params = json_decode('{"end_date": "2016-04-01", "country": "US", "aggregated_by": "day", "limit": 1, "offset": 1, "start_date": "2016-01-01"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->geo()->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
