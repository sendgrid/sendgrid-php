<?php

namespace SendGrid;

class Api {
  
  protected $username,
            $password,
            $options;

  public function __construct($username, $password, $options=array("turn_off_ssl_verification" => false)) {
    $this->username = $username;
    $this->password = $password;
    $this->options  = $options;
  }
}
