<?php

require __DIR__.'/../../../vendor/autoload.php';
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as HTTPClient;

class SendGridTest_ASMGroups extends GuzzleTestCase
{ 
  public function testGET()
  { 
    $response = new Response(
        200,
        array('Content-Type' => 'application/json'),
        '[{"id":01,"name":"Newsletter","description":"Our monthly newsletter","last_email_sent_at":null,"is_default":true,"unsubscribes":0},{"id":02,"name":"Alert","description":"Daily alerts","last_email_sent_at":null,"is_default":true,"unsubscribes":0},{"id":603,"name":"Announcements","description":"Announcements of events and features.","last_email_sent_at":null,"is_default":true,"unsubscribes":0}]'
    );
    
    $client = new HTTPClient('https://api.sendgrid.com');
    $mock = new MockPlugin();
    $mock->addResponse($response);
    $client->addSubscriber($mock);
    $sendgrid = new Client('sendgrid_apikey');
    $sendgrid->setClient($client);
    $response = $sendgrid->api_keys->get();
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals('[{"id":01,"name":"Newsletter","description":"Our monthly newsletter","last_email_sent_at":null,"is_default":true,"unsubscribes":0},{"id":02,"name":"Alert","description":"Daily alerts","last_email_sent_at":null,"is_default":true,"unsubscribes":0},{"id":603,"name":"Announcements","description":"Announcements of events and features.","last_email_sent_at":null,"is_default":true,"unsubscribes":0}]', $response->getBody());
  }
}

