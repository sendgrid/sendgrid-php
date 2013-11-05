<?php

class SendGrid {
  const VERSION = "1.1.5";

  protected $namespace = "SendGrid",
            $username,
            $password,
            $web,
            $smtp;
  
  public function __construct($username, $password) {
    $this->username = $username;
    $this->password = $password;
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

  public function __get($api) {
    $name = $api;

    if($this->$name != null) {
      return $this->$name;
    }

    $api = $this->namespace . "\\" . ucwords($api);
    $class_name = str_replace('\\', '/', "$api.php");
    $file = __dir__ . DIRECTORY_SEPARATOR . $class_name;

    if (!file_exists($file)) {
      throw new Exception("Api '$class_name' not found.");
    }
    require_once $file;

    $this->$name = new $api($this->username, $this->password);
    return $this->$name;
  }
}
