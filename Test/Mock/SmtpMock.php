<?php

class SmtpMock extends SendGrid\Smtp
{
  public function __construct($username, $password)
  {
    parent::__construct($username, $password);
  }
  
  public function getPort()
  {
    return $this->port;
  }
}