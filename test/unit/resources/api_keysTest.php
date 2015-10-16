<?php
require_once __DIR__.'/baseTest.php';

class SendGridTest_APIKeys extends baseTest
{ 
  public function testGET()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '{"result": [{"name": "default", "api_key_id": "XXXXXXXXXX"}]}';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $response = $sendgrid->api_keys->get();
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
}