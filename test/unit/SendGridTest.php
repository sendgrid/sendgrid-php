<?php

namespace SendGrid\Tests\Unit;

use SendGrid\Tests\BaseTestClass;

/**
 * This class tests the Twilio SendGrid Client.
 *
 * @package SendGrid\Tests\Unit
 */
class SendGridTest extends BaseTestClass
{
    /**
     * Test that we can connect to the Twilio SendGrid API.
     */
    public function testCanConnectToSendGridApi()
    {
        $sg = new \SendGrid(self::$apiKey);
        $headers = [
            'Authorization: Bearer ' . self::$apiKey,
            'User-Agent: sendgrid/' . $sg->version . ';php',
            'Accept: application/json'
        ];

        $this->assertEquals('https://api.sendgrid.com', $sg->client->getHost());
        $this->assertEquals($headers, $sg->client->getHeaders());
        $this->assertEquals('/v3', $sg->client->getVersion());

        $sg = new \SendGrid(self::$apiKey, ['host' => 'https://api.test.com']);
        $this->assertEquals('https://api.test.com', $sg->client->getHost());

        $sg = new \SendGrid(self::$apiKey, ['curl' => ['foo' => 'bar']]);
        $this->assertEquals(['foo' => 'bar'], $sg->client->getCurlOptions());

        $sg = new \SendGrid(
            self::$apiKey,
            ['curl' => [CURLOPT_PROXY => '127.0.0.1:8000']]
        );
        $this->assertEquals(
            [10004 => '127.0.0.1:8000'],
            $sg->client->getCurlOptions()
        );

        $subuser = 'abcxyz@this.is.a.test.subuser';
        $headers[] = 'On-Behalf-Of: ' . $subuser;
        $sg = new \SendGrid(
            self::$apiKey,
            ['impersonateSubuser' => $subuser]
        );
        $this->assertSame($headers, $sg->client->getHeaders());
    }

    /**
     * Test that user can override the API version when instantiating a new SendGrid client.
     */
    public function testCanOverridePath()
    {
        $opts['version'] = '/v4';

        $sg = new \SendGrid(self::$apiKey, $opts);

        $this->assertEquals('/v4', $sg->client->getVersion());
    }
}
