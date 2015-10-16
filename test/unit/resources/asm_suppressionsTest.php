<?php
require_once __DIR__.'/baseTest.php';

class SendGridTest_ASMSuppressions extends baseTest
{ 
  public function testGET()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '["elmer.thomas+test-add-unsub@gmail.com","elmer.thomas+test1@gmail.com"]';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $response = $sendgrid->asm_suppressions->get(70);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
  
  public function testPOST()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '{"recipient_emails":["elmer.thomas+test1@gmail.com"]}';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $group_id = 70;
    $email = 'elmer.thomas+test1@gmail.com';
    $response = $sendgrid->asm_suppressions->post($group_id, $email);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
    
    $body = '{"recipient_emails":["elmer.thomas+test1@gmail.com"]}';    
    $sendgrid = $this->buildClient($code, $headers, $body);
    $group_id = 70;
    $email = array('elmer.thomas+test2@gmail.com', 'elmer.thomas+test3@gmail.com');
    $response = $sendgrid->asm_suppressions->post($group_id, $email);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
  
  public function testDELETE()
  { 
    $code = 204;
    $headers = '';
    $body = '';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $response = $sendgrid->asm_suppressions->delete(70, "elmer.thomas+test1@gmail.com");
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
}
