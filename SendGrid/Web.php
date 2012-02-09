<?php

namespace SendGrid;

class Web extends Api implements MailInterface
{

  private $domain = "http://sendgrid.com/";
  private $endpoint = "api/mail.send.json";
  public function __construct()
  {
    call_user_func_array("parent::__construct", func_get_args());
  }

  /**
   * _prepMessageData
   * Takes the mail message and returns a url friendly querystring
   * @param  Mail   $mail [description]
   * @return String - the data query string to be posted
   */
  private function _prepMessageData(Mail $mail)
  {
    $params = 
    array(
      'api_user'  => $this->username,
      'api_key'   => $this->password,
      'subject'   => $mail->getSubject(),
      'html'      => $mail->getHtml(),
      'text'      => $mail->getText(),
      'from'      => $mail->getFrom(),
      'x-smtpapi' => $mail->getHeadersJson()
    );

    $params = http_build_query($params);
    $params.= $this->_arrayToUrlPart($mail->getTos(), "to");
    $params.= $this->_arrayToUrlPart($mail->getBccs(), "bcc");
    $params.= $this->_arrayToUrlPart($mail->getCcs(), "cc");

    return $params;
  }

  /**
   * _arrayToUrlPart
   * Converts an array to a url friendly string
   * @param  array $array - the array to convert
   * @param  String $token - the name of parameter
   * @return String - a url part that can be concatenated to a url request
   */
  private function _arrayToUrlPart($array, $token)
  {
    $string = "";

    if($array)
    {
      foreach($array as $value)
      {
        $string.= "&" . $token . "[]=" . urlencode($value);
      }
    }

    return $string;
  }

  /**
   * send
   * Send an email
   * @param  Mail   $mail - The message to send
   * @return [type]
   */
  public function send(Mail $mail)
  {
    $data = $this->_prepMessageData($mail);

    $request = $this->domain . $this->endpoint;

    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $data);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
     
    // obtain response
    $response = curl_exec($session);
    curl_close($session);

    return $response;
  }  
}