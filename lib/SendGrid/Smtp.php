<?php

namespace SendGrid;

class Smtp extends Api implements EmailInterface
{
  //the available ports
  const TLS             = 587;
  const TLS_ALTERNATIVE = 25;
  const SSL             = 465;
  const HOSTNAME        = 'smtp.sendgrid.net';

  //the list of port instances, to be recycled
  private $swift_instances = array();
  protected $port;
  protected $hostname;

  public function __construct($username, $password)
  {
    /* check for SwiftMailer,
     * if it doesn't exist, try loading
     * it from Pear
     */
    if (!class_exists('Swift')) {
      require_once 'swift_required.php';
    }
    call_user_func_array("parent::__construct", func_get_args());

    //set the defaults
    $this->port = Smtp::TLS;
    $this->hostname = Smtp::HOSTNAME;
  }

  /* setPort
   * set the SMTP outgoing port number
   * @param Int $port - the port number to use
   * @return the SMTP object
   */
  public function setPort($port)
  {
    $this->port = $port;

    return $this;
  }

  public function setHostname($hostname)
  {
    $this->hostname = $hostname;

    return $this;
  }

  /* _getSwiftInstance
   * initialize and return the swift transport instance
   * @return the Swift_Mailer instance
   */
  private function _getSwiftInstance($port)
  {
    if (!isset($this->swift_instances[$port]))
    {
      $transport = \Swift_SmtpTransport::newInstance($this->hostname, $port);
      $transport->setUsername($this->username);
      $transport->setPassword($this->password);

      $swift = \Swift_Mailer::newInstance($transport);

      $this->swift_instances[$port] = $swift;
    }

    return $this->swift_instances[$port];
  }

  /* _mapToSwift
   * Maps the SendGridMail Object to the SwiftMessage object
   * @param Email $email - the SendGridMail object
   * @return the SwiftMessage object
   */
  protected function _mapToSwift(Email $email)
  {
    $message = new \Swift_Message($email->getSubject());

    /*
     * Since we're sending transactional email, we want the message to go to one person at a time, rather
     * than a bulk send on one message. In order to do this, we'll have to send the list of recipients through the headers
     * but Swift still requires a 'to' address. So we'll falsify it with the from address, as it will be 
     * ignored anyway.
     */
    $message->setTo($email->getFrom());
    $message->setFrom($email->getFrom(true));
    $message->setCc($email->getCcs());
    $message->setBcc($email->getBccs());

    if ($email->getHtml())
    {
      $message->setBody($email->getHtml(), 'text/html');
      if ($email->getText()) $message->addPart($email->getText(), 'text/plain');
    }
    else
    {
      $message->setBody($email->getText(), 'text/plain');
    }

    if(($replyto = $email->getReplyTo())) {
      $message->setReplyTo($replyto);
    }

    // determine whether or not we can use SMTP recipients (non header based)
    if($email->useHeaders())
    {
      //send header based email
      $message->setTo($email->getFrom());

       //here we'll add the recipients list to the headers
      $headers = $email->getSmtpapiHeaders();
      $headers['to'] = $email->getTos();
      $email->setSmtpapiHeaders($headers);
    }
    else
    {
      $recipients = array();
      foreach ($email->getTos() as $recipient)
      {
        if(preg_match("/(.*)<(.*)>/", $recipient, $results))
        {
          $recipients[trim($results[2])] = trim($results[1]);
        }
        else
        {
          $recipients[] = $recipient;
        }
      }

      $message->setTo($recipients);
    }

    $attachments = $email->getAttachments();

    //add any attachments that were added
    if ($attachments)
    {
      foreach ($attachments as $attachment)
      {
        if (array_key_exists('custom_filename', $attachment)) {
          $message->attach(\Swift_Attachment::fromPath($attachment['file'])->setFileName($attachment['custom_filename']));
        } else {
          $message->attach(\Swift_Attachment::fromPath($attachment['file']));
        }
      }
    }

    //add all the headers
    $headers = $message->getHeaders();
    $headers->addTextHeader('X-SMTPAPI', $email->getSmtpapiHeadersJson());

    // Add the extra message headers (RFC 822)
    if (count($email->getMessageHeaders())) {
      foreach ($email->getMessageHeaders() as $name => $value) {
        $headers->addTextHeader($name, $value);
      }
    }

    return $message;
  }

  /* send
   * Send the Email Message
   * @param Mail $email - the SendGridMailMessage to be sent
   * @return true if mail was sendable (not necessarily sent)
   */
  public function send(Email $email)
  {
    $swift = $this->_getSwiftInstance($this->port);
    $message = $this->_mapToSwift($email);

    try 
    {
      $swift->send($message, $failures);
    }
    catch(\Swift_TransportException $e)
    {
      throw new AuthException('Bad username / password');
    }

    return true;
  }
}
