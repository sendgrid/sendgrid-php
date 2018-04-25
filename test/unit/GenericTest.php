<?php

namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;

class GenericTest extends BaseTestClass
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

    public function testHelloWorld()
    {
        $from = new \SendGrid\Mail\From("Example User", "test@example.com");
        $subject = new \SendGrid\Mail\Subject("Sending with SendGrid is Fun");
        $to = new \SendGrid\Mail\To("Example User", "test@example.com");
        $plainTextContent = new \SendGrid\Mail\PlainTextContent("and easy to do anywhere, even with PHP");
        $htmlContent = new \SendGrid\Mail\HtmlContent("<strong>and easy to do anywhere, even with PHP</strong>");
        $email = new \SendGrid\Mail\Mail(
            $from,
            $to,
            $subject,
            $plainTextContent,
            $htmlContent
        );
        $json = json_encode($email->jsonSerialize());

        $this->assertEquals(
            $json,
            '{"personalizations":[{"subject":"Sending with SendGrid is Fun"},{"to":[{"name":"test@example.com","email":"Example User"}]}],"from":{"name":"test@example.com","email":"Example User"},"content":[{"type":"text\/plain","value":"and easy to do anywhere, even with PHP"},{"type":"text\/html","value":"<strong>and easy to do anywhere, even with PHP<\/strong>"}]}'
        );
    }
}
