<?php
require __DIR__.'/../../../vendor/autoload.php';
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as HTTPClient;

class baseTest extends GuzzleTestCase
{
  public function buildClient($code, $headers, $body){
    $response = new Response($code, $headers, $body);
    $client = new HTTPClient('https://api.sendgrid.com');
    $mock = new MockPlugin();
    $mock->addResponse($response);
    $client->addSubscriber($mock);
    $sendgrid = new Client('sendgrid_apikey');
    $sendgrid->setClient($client);
    return $sendgrid;
  } 
}