<?php

namespace SendGrid;

class Smtp extends Api implements MailInterface
{

  public function __construct($username, $password)
  {
    require_once ROOT_DIR . 'lib/swift/swift_required.php';
    call_user_func_array("parent::__construct", func_get_args());
  }

  private function mapToSwift(Mail $mail)
  {
  	
  	$message = new \Swift_Message($mail->getSubject());

  	$message->setFrom($mail->getFrom());
  	$message->setBody($mail->getHtml(), 'text/html');
  	$message->setTo($mail->getTos());
  	$message->addPart($mail->getText(), 'text/plain');

  	return $message;
  }

  public function send(Mail $mail)
  {
    echo "attempting to send mail";

    $transport = \Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
  	$transport->setUsername($this->username);
  	$transport->setPassword($this->password);

    $swift = \Swift_Mailer::newInstance($transport);

    $message = $this->mapToSwift($mail);

    if ($recipients = $swift->send($message, $failures))
	{
	  // This will let us know how many users received this message
	  echo 'Message sent out to '.$recipients.' users';
	}
	// something went wrong =(
	else
	{
	  echo "Something went wrong - ";
	  print_r($failures);
	}
    

  }
}