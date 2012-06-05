<?php

namespace SendGrid;

class Smtp extends Api implements MailInterface
{
  //the available ports
  const TLS = 587;
  const TLS_ALTERNATIVE = 25;
  const SSL = 465;

  //the list of port instances, to be recycled
  private $swift_instances = array();
  protected $port;

  public function __construct($username, $password)
  {
    require_once ROOT_DIR . 'lib/swift/swift_required.php';
    call_user_func_array("parent::__construct", func_get_args());

    //set the default port
    $this->port = Smtp::TLS;
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

  /* _getSwiftInstance
   * initialize and return the swift transport instance
   * @return the Swift_Mailer instance
   */
  private function _getSwiftInstance($port)
  {
    if (!isset($this->swift_instances[$port]))
    {
      $transport = \Swift_SmtpTransport::newInstance('smtp.sendgrid.net', $port);
      $transport->setUsername($this->username);
      $transport->setPassword($this->password);

      $swift = \Swift_Mailer::newInstance($transport);

      $this->swift_instances[$port] = $swift;
    }

    return $this->swift_instances[$port];
  }

  /* _mapToSwift
   * Maps the SendGridMail Object to the SwiftMessage object
   * @param Mail $mail - the SendGridMail object
   * @return the SwiftMessage object
   */
  protected function _mapToSwift(Mail $mail)
  {
    $message = new \Swift_Message($mail->getSubject());

    /*
     * Since we're sending transactional email, we want the message to go to one person at a time, rather
     * than a bulk send on one message. In order to do this, we'll have to send the list of recipients through the headers
     * but Swift still requires a 'to' address. So we'll falsify it with the from address, as it will be 
     * ignored anyway.
     */
    $message->setTo($mail->getFrom());
    $message->setFrom($mail->getFrom(true));
    $message->setBody($mail->getHtml(), 'text/html');
    $message->addPart($mail->getText(), 'text/plain');
    $message->setCc($mail->getCcs());
    $message->setBcc($mail->getBccs());

    if(($replyto = $mail->getReplyTo())) {
      $message->setReplyTo($replyto);
    }

    // determine whether or not we can use SMTP recipients (non header based)
    if($mail->useHeaders())
    {
      //send header based email
      $message->setTo($mail->getFrom());

       //here we'll add the recipients list to the headers
      $headers = $mail->getHeaders();
      $headers['to'] = $mail->getTos();
      $mail->setHeaders($headers);
    }
    else
    {
      $recipients = array();
      foreach ($mail->getTos() as $recipient)
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

    $attachments = $mail->getAttachments();

    //add any attachments that were added
    if ($attachments)
    {
      foreach ($attachments as $attachment)
      {
        $message->attach(\Swift_Attachment::fromPath($attachment['file']));
      }
    }

    //add all the headers
    $headers = $message->getHeaders();
    $headers->addTextHeader('X-SMTPAPI', $mail->getHeadersJson());

    return $message;
  }

  /* send
   * Send the Mail Message
   * @param Mail $mail - the SendGridMailMessage to be sent
   * @return true if mail was sendable (not necessarily sent)
   */
  public function send(Mail $mail)
  {
    $swift = $this->_getSwiftInstance($this->port);

    $message = $this->_mapToSwift($mail);

    $swift->send($message, $failures);

    return true;
  }
}
