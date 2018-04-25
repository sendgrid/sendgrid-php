<?php

namespace SendGrid\Tests\Scopes;

use SendGrid\Tests\BaseTestClass;

class ScopesTest extends BaseTestClass
{
    public function testScopesGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->scopes()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
