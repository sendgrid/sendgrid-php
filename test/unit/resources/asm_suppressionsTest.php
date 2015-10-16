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
  
  public function testPOST()
  { 
    $response = new Response(
        201,
        array('Content-Type' => 'application/json'),
        '{"recipient_emails":["elmer.thomas+test1@gmail.com"]}'
    );
    
    $client = new HTTPClient('https://api.sendgrid.com');
    $mock = new MockPlugin();
    $mock->addResponse($response);
    $client->addSubscriber($mock);
    $sendgrid = new Client('sendgrid_apikey');
    $sendgrid->setClient($client);
    $group_id = 70;
    $email = 'elmer.thomas+test1@gmail.com';
    $response = $sendgrid->asm_suppressions->post($group_id, $email);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals('{"recipient_emails":["elmer.thomas+test1@gmail.com"]}', $response->getBody());
    
    $response = new Response(
        201,
        array('Content-Type' => 'application/json'),
        '{"recipient_emails":["elmer.thomas+test2@gmail.com","elmer.thomas+test3@gmail.com"]}'
    );
    
    $client = new HTTPClient('https://api.sendgrid.com');
    $mock = new MockPlugin();
    $mock->addResponse($response);
    $client->addSubscriber($mock);
    $sendgrid = new Client('sendgrid_apikey');
    $sendgrid->setClient($client);
    $group_id = 70;
    $email = array('elmer.thomas+test2@gmail.com', 'elmer.thomas+test3@gmail.com');
    $response = $sendgrid->asm_suppressions->post($group_id, $email);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals('{"recipient_emails":["elmer.thomas+test2@gmail.com","elmer.thomas+test3@gmail.com"]}', $response->getBody());
  }
  
  public function testDELETE()
  { 
    $response = new Response(204,'');
    
    $client = new HTTPClient('https://api.sendgrid.com');
    $mock = new MockPlugin();
    $mock->addResponse($response);
    $client->addSubscriber($mock);
    $sendgrid = new Client('sendgrid_apikey');
    $sendgrid->setClient($client);
    $response = $sendgrid->asm_suppressions->delete(70, "elmer.thomas+test1@gmail.com");
    $this->assertEquals(204, $response->getStatusCode());
    $this->assertEquals('', $response->getBody());
  }
}
