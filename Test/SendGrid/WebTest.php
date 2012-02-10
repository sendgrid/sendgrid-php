<?php 

class WebTest extends PHPUnit_Framework_TestCase
{
  public function testConstruction()
  {
    $sendgrid = new SendGrid("foo", "bar");

    $web = $sendgrid->web;

    $this->assertEquals(new SendGrid\Web("foo", "bar"), $web);
    $this->assertEquals(get_class($web), "SendGrid\Web");
  }

  public function testMockFunctions()
  {
    $message = new SendGrid\Mail();

    $message->
      setFrom('bar@foo.com')->
      setSubject('foobar subject')->
      setText('foobar text')->
      addTo('foo@bar.com')->
      addAttachment("mynewattachment.jpg");

    $mock = new WebMock("foo", "bar");
    $data = $mock->testPrepMessageData($message);

    $expected = 
    array(
      'api_user' => 'foo',
      'api_key' => 'bar',
      'subject' => 'foobar subject',
      'html' => null,
      'text' => 'foobar text',
      'from' => 'bar@foo.com',
      'to' => 'bar@foo.com',
      'x-smtpapi' => '{"to":["foo@bar.com"]}',
      'files[mynewattachment.jpg]' => '@mynewattachment.jpg'
    );

    $this->assertEquals($expected, $data);


    $array = 
      array(
        "foo", 
        "bar", 
        "car", 
        "doo"
      );

    $url_part = $mock->testArrayToUrlPart($array, "param");

    $this->assertEquals("&param[]=foo&param[]=bar&param[]=car&param[]=doo", $url_part);
  }

  public function testSendResponse()
  {
    $sendgrid = new SendGrid("foo", "bar");

    $message = new SendGrid\Mail();

    $message->
      setFrom('bar@foo.com')->
      setSubject('foobar subject')->
      setText('foobar text')->
      addTo('foo@bar.com');

    $response = $sendgrid->web->send($message);

    $this->assertEquals("{\"message\": \"error\", \"errors\": [\"Bad username / password\"]}", $response);
  }
}