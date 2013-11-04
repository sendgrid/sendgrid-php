<?php

//include(dirname(dirname(__FILE__)) . '/lib/SendGrid.php');
//SendGrid::register_autoloader();

class SendGridTest_SendGrid extends PHPUnit_Framework_TestCase {

  public function testVersion() {
    $this->assertEquals(SendGrid::VERSION, "1.1.4");
  }

  public function testInitialization() {
    $sendgrid = new SendGrid("user", "pass");
    $this->assertEquals("SendGrid", get_class($sendgrid));
  }

  public function testWebInitialization() {
    $sendgrid = new SendGrid("user", "pass");
    $smtp     = $sendgrid->web; 
    
    $this->assertEquals("SendGrid\Web", get_class($smtp));
  }

  public function testSmtpInitialization() {
    $sendgrid = new SendGrid("user", "pass");
    $smtp     = $sendgrid->smtp; 
    
    $this->assertEquals("SendGrid\Smtp", get_class($smtp));
  }

  public function testNonexistentInitialization() {
    $sendgrid = new SendGrid("user", "pass");

    try {
      $smtp     = $sendgrid->nonexistent; 
    } catch (Exception $e) {
      return;
    }
    $this->fail('A non object was instanciated');
  }
}
