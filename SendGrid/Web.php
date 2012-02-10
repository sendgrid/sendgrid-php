<?php

namespace SendGrid;

class Web extends Api implements MailInterface
{

  protected $domain = "http://sendgrid.com/";
  protected $endpoint = "api/mail.send.json";

  /**
   * __construct
   * Create a new Web instance
   */
  public function __construct($username, $password)
  {
    call_user_func_array("parent::__construct", func_get_args());
  }

  /**
   * _prepMessageData
   * Takes the mail message and returns a url friendly querystring
   * @param  Mail   $mail [description]
   * @return String - the data query string to be posted
   */
  protected function _prepMessageData(Mail $mail)
  {

    /* the api expects a 'to' parameter, but this parameter will be ignored
     * since we're sending the recipients through the header. The from
     * address will be used as a placeholder.
     */
    $params = 
    array(
      'api_user'  => $this->username,
      'api_key'   => $this->password,
      'subject'   => $mail->getSubject(),
      'html'      => $mail->getHtml(),
      'text'      => $mail->getText(),
      'from'      => $mail->getFrom(),
      'to'        => $mail->getFrom(),
      'x-smtpapi' => $mail->getHeadersJson()
    );

    // determine if we should send our recipients through our headers,
    // and set the properties accordingly
    if($mail->useHeaders())
    {
      // workaround for posting recipients through SendGrid headers
      $headers = $mail->getHeaders();
      $headers['to'] = $mail->getTos();
      $mail->setHeaders($headers);

      $params['x-smtpapi'] = $mail->getHeadersJson();
    }
    else
    {
      $params['to'] = $mail->getTos();
    }

    
    if($mail->getAttachments())
    {
      foreach($mail->getAttachments() as $attachment)
      {
        $params['files['.$attachment['filename'].'.'.$attachment['extension'].']'] = '@'.$attachment['file'];
      }
    }

    return $params;
  }

  /**
   * _arrayToUrlPart
   * Converts an array to a url friendly string
   * @param  array $array - the array to convert
   * @param  String $token - the name of parameter
   * @return String - a url part that can be concatenated to a url request
   */
  protected function _arrayToUrlPart($array, $token)
  {
    $string = "";

    if ($array)
    {
      foreach ($array as $value)
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
   * @return String the json response
   */
  public function send(Mail $mail)
  {
    $data = $this->_prepMessageData($mail);

    //if we're not using headers, we need to send a url friendly post
    if(!$mail->useHeaders())
    {
      $data = http_build_query($data);
    }

    $request = $this->domain . $this->endpoint;

    // we'll append the Bcc and Cc recipients to the url endpoint (GET)
    // so that we can still post attachments (via cURL array).
    $request.= "?" .
      substr($this->_arrayToUrlPart($mail->getBccs(), "bcc"), 1) .
      $this->_arrayToUrlPart($mail->getCcs(), "cc");

    $session = curl_init($request);
    curl_setopt ($session, CURLOPT_POST, true);
    curl_setopt ($session, CURLOPT_POSTFIELDS, $data);

    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
     
    // obtain response
    $response = curl_exec($session);
    curl_close($session);

    return $response;
  }  
}