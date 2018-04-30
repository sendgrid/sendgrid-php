<?php

namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;

class SendGridTest extends BaseTestClass
{
    public function testVersionIsCorrect()
    {
        $this->assertEquals(\SendGrid::VERSION, '6.2.0');
        $this->assertEquals(json_decode(file_get_contents(__DIR__ . '/../../composer.json'))->version, \SendGrid::VERSION);
    }

    public function testCanConnectToSendGridApi()
    {
        $sg = new \SendGrid(self::$apiKey);
        $headers = [
            'Authorization: Bearer ' . self::$apiKey,
            'User-Agent: sendgrid/' . $sg->version . ';php',
            'Accept: application/json'
        ];

        $this->assertEquals($sg->client->getHost(), 'https://api.sendgrid.com', '/v3');
        $this->assertEquals($sg->client->getHeaders(), $headers);
        $this->assertEquals($sg->client->getVersion(), '/v3');

        $sg2 = new \SendGrid(self::$apiKey, ['host' => 'https://api.test.com']);
        $this->assertEquals($sg2->client->getHost(), 'https://api.test.com');

        $sg3 = new \SendGrid(self::$apiKey, ['curl' => ['foo' => 'bar']]);
        $this->assertEquals(['foo' => 'bar'], $sg3->client->getCurlOptions());

        $sg4 = new \SendGrid(self::$apiKey, ['curl' => [CURLOPT_PROXY => '127.0.0.1:8000']]);
        $this->assertEquals($sg4->client->getCurlOptions(), [10004 => '127.0.0.1:8000']);
    }
}
