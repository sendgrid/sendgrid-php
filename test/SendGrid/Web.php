<?php 

class SendGridTest_Web extends PHPUnit_Framework_TestCase {

  public function testConstruction() {
    $sendgrid = new SendGrid("foo", "bar");

    $web = $sendgrid->web;

    $this->assertEquals(new SendGrid\Web("foo", "bar"), $web);
    $this->assertEquals(get_class($web), "SendGrid\Web");
  }

  public function testSendResponse() {
    $sendgrid = new SendGrid("foo", "bar");

    $email = new SendGrid\Email();
    $email->setFrom('bar@foo.com')->
            setSubject('foobar subject')->
            setText('foobar text')->
            addTo('foo@bar.com');

    $response = $sendgrid->web->send($email);

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

    $response = $sendgrid->web->send($email);

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

    $response = $sendgrid->web->send($email);

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

    $response = $sendgrid->web->send($email);

    $this->assertEquals("Bad username / password", $response->errors[0]);

  }
}
