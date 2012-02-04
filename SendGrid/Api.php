<?php

namespace SendGrid;

class Api
{
  
  protected $username,
            $password;

  public function __construct($username, $password)
  {
    $this->username = $username;
    $this->password = $password;
  }

}