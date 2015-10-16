<?php
require_once __DIR__.'/baseTest.php';

class SendGridTest_ASMGroups extends baseTest
{ 
  public function testGET()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '[{"id":01,"name":"Newsletter","description":"Our monthly newsletter","last_email_sent_at":null,"is_default":true,"unsubscribes":0},{"id":02,"name":"Alert","description":"Daily alerts","last_email_sent_at":null,"is_default":true,"unsubscribes":0},{"id":603,"name":"Announcements","description":"Announcements of events and features.","last_email_sent_at":null,"is_default":true,"unsubscribes":0}]';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $response = $sendgrid->asm_groups->get();
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
}

