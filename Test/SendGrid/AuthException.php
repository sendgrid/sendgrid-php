<?php

class SendGridTest_AuthException extends PHPUnit_Framework_TestCase {

  public function testInitialization() {
    $auth_exception = new SendGrid\AuthException();
    $this->assertEquals("SendGrid\AuthException", get_class($auth_exception));
  }
}
