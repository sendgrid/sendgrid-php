<?php

class SmtpTest extends PHPUnit_Framework_TestCase
{
  public function testConstruction()
  {
    $sendgrid = new SendGrid("foo", "bar");

    $smtp = $sendgrid->smtp;

    $this->assertEquals(new SendGrid\Smtp("foo", "bar"), $smtp);

    $message = new SendGrid\Mail();
    $message->
      setFrom('bar@foo.com')->
      setFromName('John Doe')->
      setSubject('foobar subject')->
      setText('foobar text')->
      addTo('foo@bar.com')->
      addAttachment("mynewattachment.jpg");

    $this->assertEquals(get_class($smtp), 'SendGrid\Smtp');

    $this->setExpectedException('Swift_TransportException');
    $smtp->send($message);
  }

  public function testPorts()
  {
    $this->assertEquals(587, SendGrid\Smtp::TLS);
    $this->assertEquals(25, SendGrid\Smtp::TLS_ALTERNATIVE);
    $this->assertEquals(465, SendGrid\Smtp::SSL);

    $sendgrid = new SendGrid("foo", "bar");

    //we can't check that the port works, but we can check that it doesn't throw an exception
    $object = $sendgrid->smtp->setPort(SendGrid\Smtp::TLS);

    $this->assertEquals($sendgrid->smtp, $object);
    $this->assertEquals(get_class($object), 'SendGrid\Smtp');


    $mock = new SmtpMock('foo', 'bar');

    $mock->setPort('52');
    $this->assertEquals('52', $mock->getPort());
  }

  public function testEmailBodyAttachments()
  {
    $_mapToSwift = new ReflectionMethod('SendGrid\Smtp', '_mapToSwift');
    $_mapToSwift->setAccessible(true);

    $sendgrid = new SendGrid("foo", "bar");
    $message = new SendGrid\Mail();
    $message->
      setFrom('bar@foo.com')->
      setFromName('John Doe')->
      setSubject('foobar subject')->
      setHtml('foobar html')->
      addTo('foo@bar.com');

    $swift_message = $_mapToSwift->invoke($sendgrid->smtp, $message);
    $this->assertEquals(count($swift_message->getChildren()), 0);

    $message->setText('foobar text');

    $swift_message = $_mapToSwift->invoke($sendgrid->smtp, $message);
    $this->assertEquals(count($swift_message->getChildren()), 1);
    $body_attachments = $swift_message->getChildren();
    $this->assertEquals($body_attachments[0]->getContentType(), 'text/plain');
  }

  public function testEmailTextBodyAttachments()
  {
    $_mapToSwift = new ReflectionMethod('SendGrid\Smtp', '_mapToSwift');
    $_mapToSwift->setAccessible(true);

    $sendgrid = new SendGrid("foo", "bar");
    $message = new SendGrid\Mail();
    $message->
      setFrom('bar@foo.com')->
      setFromName('John Doe')->
      setSubject('foobar subject')->
      setText('foobar text')->
      addTo('foo@bar.com');

    $swift_message = $_mapToSwift->invoke($sendgrid->smtp, $message);
    $this->assertEquals(count($swift_message->getChildren()), 0);
  }
}
