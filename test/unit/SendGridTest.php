<?php

class SendGridTest_SendGrid extends PHPUnit_Framework_TestCase
{
    public function testVersion()
    {
        $this->assertEquals(SendGrid::VERSION, '5.0.0');
        $this->assertEquals(json_decode(file_get_contents(__DIR__ . '/../../composer.json'))->version, SendGrid::VERSION);
    }
    
    public function testSendGrid()
    {
        $apiKey = "SENDGRID_API_KEY";
        $sg = new SendGrid($apiKey);
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$apiKey,
            'User-Agent: sendgrid/' . $sg->version . ';php'
            );
        $this->assertEquals($sg->client->host, "https://api.sendgrid.com");
        $this->assertEquals($sg->client->request_headers, $headers);
        $this->assertEquals($sg->client->version, "/v3");
        
        $apiKey = "SENDGRID_API_KEY";
        $sg2 = new SendGrid($apiKey, array('host' => 'https://api.test.com'));
        $this->assertEquals($sg2->client->host, "https://api.test.com");
    }
}
