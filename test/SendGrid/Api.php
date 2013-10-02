<?php

class SendGridTest_Api extends PHPUnit_Framework_TestCase {

  public function testInitialization() {
    $api      = new SendGrid\Api("user", "pass");
    $this->assertEquals("SendGrid\Api", get_class($api));
  }
}

