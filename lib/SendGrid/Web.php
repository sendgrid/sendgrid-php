<?php

namespace SendGrid;

class Web extends Api implements EmailInterface {

  protected $url      = "https://api.sendgrid.com/api/mail.send.json";
  protected $headers  = array('Content-Type' => 'application/json');

  public function send(Email $email) {
    $form             = $email->toWebFormat();
    $form['api_user'] = $this->username; 
    $form['api_key']  = $this->password; 

    // option to ignore verification of ssl certificate
    if (isset($this->options['turn_off_ssl_verification']) && isset($this->options['turn_off_ssl_verification']) && $this->options['turn_off_ssl_verification'] == true) {
      \Unirest::verifyPeer(false);
    }

    $response = \Unirest::post($this->url, array(), $form);

    return $response->body;
  }
}
