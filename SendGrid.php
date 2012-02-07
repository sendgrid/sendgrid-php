<?php

class SendGrid
{
  private $namespace = "SendGrid",
          $username,
          $password;
  
  public function __construct($username, $password)
  {
    $this->username = $username;
    $this->password = $password;
  }

  public function __get($api)
  {
    $name = $api;
    $api = "$this->namespace\\".ucwords($api);
    $class_name = str_replace('\\', '/', "$api.php");
    $file = __dir__ . DIRECTORY_SEPARATOR . $class_name;

    if (!file_exists($file))
    {
      throw new Exception("Api '$class_name' not found.");
    }
    require_once $file;

    $this->$name = new $api($this->username, $this->password);
    return $this->$name;
  }

}
