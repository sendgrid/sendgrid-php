<?php

class SendGrid {
  const VERSION = '2.2.0';

  protected $namespace  = 'SendGrid',
            $headers    = array('Content-Type' => 'application/json'),
            $options,
            $web;
  public    $api_user,
            $api_key,
            $url,
            $version = self::VERSION;

  
  public function __construct($api_user, $api_key, $options=array()) {
    $this->api_user = $api_user;
    $this->api_key = $api_key;

    $options['turn_off_ssl_verification'] = (isset($options['turn_off_ssl_verification']) && $options['turn_off_ssl_verification'] === true);
    $protocol = isset($options['protocol']) ? $options['protocol'] : 'https';
    $host = isset($options['host']) ? $options['host'] : 'api.sendgrid.com';
    $port = isset($options['port']) ? $options['port'] : '';
    $endpoint = isset($options['endpoint']) ? $options['endpoint'] : '/api/mail.send.json';

    $this->url = isset($options['url']) ? $options['url'] : $protocol . '://' . $host . ($port ? ':' . $port : '') . $endpoint;

    $this->options  = $options;
  }

  public function send(SendGrid\Email $email) {
    $form             = $email->toWebFormat();
    $form['api_user'] = $this->api_user; 
    $form['api_key']  = $this->api_key; 

    $response = $this->makeRequest($form);

    return $response;
  }

  /**
   * Makes the actual HTTP request to SendGrid
   * @param $form array web ready version of SendGrid\Email
   * @return stdClass parsed JSON returned from SendGrid
   */
  private function makeRequest($form) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $this->url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $form);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'sendgrid/' . $this->version . ';php');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->options['turn_off_ssl_verification']);

    $response = curl_exec($ch);

    $error = curl_error($ch);
    if ($error) {
      throw new Exception($error);
    }

    curl_close($ch);

    return json_decode($response);
  }

  public static function register_autoloader() {
    spl_autoload_register(array('SendGrid', 'autoloader'));
  }

  public static function autoloader($class) {
    // Check that the class starts with 'SendGrid'
    if ($class == 'SendGrid' || stripos($class, 'SendGrid\\') === 0) {
      $file = str_replace('\\', '/', $class);

      if (file_exists(dirname(__FILE__) . '/' . $file . '.php')) {
        require_once(dirname(__FILE__) . '/' . $file . '.php');
      }
    }
  }
}
