<?php

namespace SendGrid\Tests\Stats;

use SendGrid\Tests\BaseTestClass;

class ClientsStatsTest extends BaseTestClass
{
    public function testClientsStatsGetMethod()
    {
        $query_params = json_decode('{"aggregated_by": "day", "start_date": "2016-01-01", "end_date": "2016-04-01"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->clients()->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testClientsClientTypeStatsGetMethod()
    {
        $query_params = json_decode('{"aggregated_by": "day", "start_date": "2016-01-01", "end_date": "2016-04-01"}');
        $client_type = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->clients()->_($client_type)->stats()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
