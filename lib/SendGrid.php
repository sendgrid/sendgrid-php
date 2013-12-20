<?php

class SendGrid {
  const VERSION = "2.0.0-rc.1.0";

  protected $namespace  = "SendGrid",
            $url        = "https://api.sendgrid.com/api/mail.send.json",
            $headers    = array('Content-Type' => 'application/json'),
            $username,
            $password,
            $web;
  
  public function __construct($username, $password) {
    $this->username = $username;
    $this->password = $password;
  }

  public function send(SendGrid\Email $email) {
    $form             = $email->toWebFormat();
    $form['api_user'] = $this->username; 
    $form['api_key']  = $this->password; 

    $response = \Unirest::post($this->url, array(), $form);

    return $response->body;
  }

  public static function register_autoloader() {
    spl_autoload_register(array('SendGrid', 'autoloader'));
  }

  public static function autoloader($class) {
    // Check that the class starts with "SendGrid"
    if ($class == 'SendGrid' || stripos($class, 'SendGrid\\') === 0) {
      $file = str_replace('\\', '/', $class);

      if (file_exists(dirname(__FILE__) . '/' . $file . '.php')) {
        require_once(dirname(__FILE__) . '/' . $file . '.php');
      }
    }
  }
}
