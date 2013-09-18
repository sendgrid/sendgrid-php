<?php

class SendGridTest extends PHPUnit_Framework_TestCase
{

  public function testConstruction()
  {
    $sendgrid = new SendGrid("fake_username", "fake_password");

    $this->assertEquals("SendGrid", get_class($sendgrid));
  }

  public function testInitializers()
  {
    $sendgrid = new SendGrid("fake_username", "fake_password");

    // test the working initializers that we currently have
    $smtp = $sendgrid->smtp;
    $web = $sendgrid->web;

    $this->assertEquals("SendGrid\Smtp", get_class($smtp));
    $this->assertEquals("SendGrid\Web", get_class($web));

    try 
    {
      $sendgrid->notanapi;
    } 
    catch (Exception $e) 
    {
      return;
    }

    $this->fail('A non object was instanciated');
  }

  public function testVersion()
  {
    $this->assertEquals(SendGrid::VERSION, "1.0.9");
  }
}
