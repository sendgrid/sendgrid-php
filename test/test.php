<?php

require '../SendGrid.php';
require '../SendGridMail.php';

class SendGridTest extends PHPUnit_Framework_TestCase
{

  public function setUp()
  {
    $this->sendgrid = new SendGrid();
  }

  public function testSimpleSend()
  {
    $mail = new SendGridMail();

    $mail->setTo('foo@bar.com');
    
    $headers = $mail->getHeaders();
    $expected = '{}';

    $this->assertEquals($headers, $expected);
  }
}