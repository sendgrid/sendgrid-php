<?php

namespace SendGrid\Tests\Integration\Suppression;

use SendGrid\Tests\BaseTestClass;

class SuppressionUnsubscribesTest extends BaseTestClass
{
    public function testSuppressionUnsubscribesGetMethod()
    {
        $query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->suppression()->unsubscribes()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
