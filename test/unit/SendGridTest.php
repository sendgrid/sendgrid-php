<?php
/**
 * This file tests the SendGrid Client
 * 
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid 
 */
namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;

/**
 * This class tests the SendGrid Client
 * 
 * @package SendGrid\Tests
 */
class SendGridTest extends BaseTestClass
{
    /**
     * Test if the version is correct
     * 
     * @return null
     */ 
    public function testVersionIsCorrect()
    {
        $this->assertEquals(\SendGrid::VERSION, '7.0.0');
        $version = json_decode(
            file_get_contents(__DIR__ . '/../../composer.json')
        )->version;
        $this->assertEquals(
            $version,
            \SendGrid::VERSION
        );
    }

    /**
     * Test that we can connect to the SendGrid API
     * 
     * @return null
     */ 
    public function testCanConnectToSendGridApi()
    {
        $sg = new \SendGrid(self::$apiKey);
        $headers = [
            'Authorization: Bearer ' . self::$apiKey,
            'User-Agent: sendgrid/' . $sg->version . ';php',
            'Accept: application/json'
        ];

        $this->assertEquals(
            $sg->client->getHost(),
            'https://api.sendgrid.com',
            '/v3'
        );
        $this->assertEquals(
            $sg->client->getHeaders(),
            $headers
        );
        $this->assertEquals($sg->client->getVersion(), '/v3');

        $sg2 = new \SendGrid(self::$apiKey, ['host' => 'https://api.test.com']);
        $this->assertEquals($sg2->client->getHost(), 'https://api.test.com');

        $sg3 = new \SendGrid(self::$apiKey, ['curl' => ['foo' => 'bar']]);
        $this->assertEquals(['foo' => 'bar'], $sg3->client->getCurlOptions());

        $sg4 = new \SendGrid(
            self::$apiKey,
            ['curl' => [CURLOPT_PROXY => '127.0.0.1:8000']]
        );
        $this->assertEquals(
            $sg4->client->getCurlOptions(),
            [10004 => '127.0.0.1:8000']
        );
    }
}
