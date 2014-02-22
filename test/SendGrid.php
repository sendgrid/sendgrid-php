<?php

class SendGridTest_SendGrid extends PHPUnit_Framework_TestCase {

  public function testVersion() {
    $this->assertEquals(SendGrid::VERSION, "2.0.3");
  }

  public function testInitialization() {
    $sendgrid = new SendGrid("user", "pass");
    $this->assertEquals("SendGrid", get_class($sendgrid));
  }

  public function testSendResponse() {
    $sendgrid = new SendGrid("foo", "bar");

    $email = new SendGrid\Email();
    $email->setFrom('bar@foo.com')->
            setSubject('foobar subject')->
            setText('foobar text')->
            addTo('foo@bar.com');

    $response = $sendgrid->send($email);

    $this->assertEquals("Bad username / password", $response->errors[0]);
  }

  public function testSendResponseWithAttachment() {
    $sendgrid = new SendGrid("foo", "bar");

    $email = new SendGrid\Email();
    $email->setFrom('p1@mailinator.com')->
            setSubject('foobar subject')->
            setText('foobar text')->
            addTo('p1@mailinator.com')->
            addAttachment('./gif.gif');

    $response = $sendgrid->send($email);

    $this->assertEquals("Bad username / password", $response->errors[0]);
  }

  public function testSendResponseWithAttachmentMissingExtension() {
    $sendgrid = new SendGrid("foo", "bar");

    $email = new SendGrid\Email();
    $email->setFrom('p1@mailinator.com')->
            setSubject('foobar subject')->
            setText('foobar text')->
            addTo('p1@mailinator.com')->
            addAttachment('./text');

    $response = $sendgrid->send($email);

    $this->assertEquals("Bad username / password", $response->errors[0]);
  }

  public function testSendResponseWithSslOptionFalse() {
    $sendgrid = new SendGrid("foo", "bar", array("switch_off_ssl_verification" => true));

    $email = new SendGrid\Email();
    $email->setFrom('p1@mailinator.com')->
            setSubject('foobar subject')->
            setText('foobar text')->
            addTo('p1@mailinator.com')->
            addAttachment('./text');

    $response = $sendgrid->send($email);

    $this->assertEquals("Bad username / password", $response->errors[0]);

  }

}
