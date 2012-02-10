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

    $message->setFrom($mail->getFrom());
    $message->setBody($mail->getHtml(), 'text/html');
    $message->setTo($mail->getTos());
    $message->addPart($mail->getText(), 'text/plain');
    $message->setCc($mail->getCcs());
    $message->setBcc($mail->getBccs());

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