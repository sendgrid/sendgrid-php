<?php

require __DIR__.'/../../../vendor/autoload.php';
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as HTTPClient;

class SendGridTest_APIKeys extends GuzzleTestCase
{ 
  public function testGET()
  { 
    $response = new Response(
        200,
        array('Content-Type' => 'application/json'),
        '{"result": [{"name": "default", "api_key_id": "XXXXXXXXXX"}]}'
    );
    
    $client = new HTTPClient('https://api.sendgrid.com');
    $mock = new MockPlugin();
    $mock->addResponse($response);
    $client->addSubscriber($mock);
    $sendgrid = new Client('sendgrid_apikey');
    $sendgrid->setClient($client);
    $response = $sendgrid->api_keys->get();
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals("{\"result\": [{\"name\": \"default\", \"api_key_id\": \"XXXXXXXXXX\"}]}", $response->getBody());
  }
}