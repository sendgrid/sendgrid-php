<?php

class WebMock extends SendGrid\Web
{
  public function __construct($username, $password)
  {
    parent::__construct($username, $password);
  }

  public function testPrepMessageData(SendGrid\Mail $mail)
  {
    return $this->_prepMessageData($mail);
  }

  public function testArrayToUrlPart($array, $token)
  {
    return $this->_arrayToUrlPart($array, $token);
  }
}