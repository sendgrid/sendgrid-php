<?php

class SendGrid
{
  protected $namespace = "SendGrid";
  /** @var string Sendgrid API key. */
  protected $apiKey;

  // Available transport mechanisms
  protected $web,
            $smtp;
  
  public function __construct($apiKey)
  {
    $this->apiKey = $apiKey;
  }

  public function __get($api)
  {
    $name = $api;

    if($this->$name != null)
    {
      return $this->$name;
    }

    $api = $this->namespace . "\\" . ucwords($api);
    $class_name = str_replace('\\', '/', "$api.php");
    $file = __dir__ . DIRECTORY_SEPARATOR . $class_name;

    if (!file_exists($file))
    {
      throw new Exception("Api '$class_name' not found.");
    }
    require_once $file;

    $this->$name = new $api($this->apiKey);
    return $this->$name;
  }
}
