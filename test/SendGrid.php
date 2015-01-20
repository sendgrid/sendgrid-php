<?php

use \Mockery as m;

class SendGridTest_SendGrid extends PHPUnit_Framework_TestCase {

  public function tearDown() {
    m::close();
  }

  public function testVersion() {
    $this->assertEquals(SendGrid::VERSION, '2.2.0');
    $this->assertEquals(json_decode(file_get_contents('../composer.json'))->version, SendGrid::VERSION);
  }

  public function testInitialization() {
    $sendgrid = new SendGrid('user', 'pass');
    $this->assertEquals('SendGrid', get_class($sendgrid));
  }

  public function testDefaultURL() {
    $sendgrid = new SendGrid('user', 'pass');
    $this->assertEquals('https://api.sendgrid.com/api/mail.send.json', $sendgrid->url);
  }

  public function testCustomURL() {
    $options = array( 'protocol' => 'http', 'host' => 'sendgrid.org', 'endpoint' => '/send', 'port' => '80' );
    $sendgrid = new SendGrid('user', 'pass', $options);
    $this->assertEquals('http://sendgrid.org:80/send', $sendgrid->url);
  }

  public function testSwitchOffSSLVerification() {
    $sendgrid = new SendGrid('foo', 'bar', array('turn_off_ssl_verification' => true));
    $options = $sendgrid->getOptions();
    $this->assertTrue(isset($options['turn_off_ssl_verification']));
  }

  /**
   * @expectedException SendGrid\Exception
   */
  public function testSendGridExceptionThrownWhenNot200() {
    $mockResponse = (object)array('code' => 400, 'raw_body' => "{'message': 'error', 'errors': ['Bad username / password']}");

    $sendgrid = m::mock('SendGrid[makeRequest]', array('foo', 'bar'));
    $sendgrid->shouldReceive('makeRequest')->once()->andReturn($mockResponse);

    $email = new SendGrid\Email();
    $email->setFrom('bar@foo.com')->
            setSubject('foobar subject')->
            setText('foobar text')->
            addTo('foo@bar.com');

    $response = $sendgrid->send($email);
  }

  public function testSendGridExceptionNotThrownWhen200() {
    $mockResponse = (object)array('code' => 200, 'body' => (object)array('message' => 'success'));

    $sendgrid = m::mock('SendGrid[makeRequest]', array('foo', 'bar'));
    $sendgrid->shouldReceive('makeRequest')->once()->andReturn($mockResponse);

    $email = new SendGrid\Email();
    $email->setFrom('bar@foo.com')->
            setSubject('foobar subject')->
            setText('foobar text')->
            addTo('foo@bar.com');

    $response = $sendgrid->send($email);
  }
}

