<?php

class SendGridTest_Response extends PHPUnit_Framework_TestCase {

  public function tearDown() {
  }

  public function testConstructionResponse() {
    $res = new SendGrid\Response(200, 'headers', 'raw_body', 'body');
    $this->assertEquals(get_class($res), 'SendGrid\Response');
  }

  public function testPublicAttributes() {
    $res = new SendGrid\Response(200, 'headers', 'raw_body', 'body');
    $this->assertEquals($res->code, 200);
    $this->assertEquals($res->headers, 'headers');
    $this->assertEquals($res->raw_body, 'raw_body');
    $this->assertEquals($res->body, 'body');
  }

}
