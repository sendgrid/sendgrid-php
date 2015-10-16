<?php

require __DIR__.'/../../../vendor/autoload.php';
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as HTTPClient;

class SendGridTest_ASMSuppressions extends GuzzleTestCase
{ 
  public function testGET()
  { 
    $response = new Response(
        200,
        array('Content-Type' => 'application/json'),
        '["elmer.thomas+test-add-unsub@gmail.com","elmer.thomas+test1@gmail.com"]'
    );
    
    $client = new HTTPClient('https://api.sendgrid.com');
    $mock = new MockPlugin();
    $mock->addResponse($response);
    $client->addSubscriber($mock);
    $sendgrid = new Client('sendgrid_apikey');
    $sendgrid->setClient($client);
    $response = $sendgrid->asm_suppressions->get(70);
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals('["elmer.thomas+test-add-unsub@gmail.com","elmer.thomas+test1@gmail.com"]', $response->getBody());
  }
}
