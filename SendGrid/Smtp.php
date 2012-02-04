<?php

namespace SendGrid;

class Smtp extends Api implements MailInterface
{

  public function __construct($username, $password)
  {
    require_once ROOT_DIR . 'lib/swift/swift_required.php';
    call_user_func_array("parent::__construct", func_get_args());
  }

  public function send(Mail $mail)
  {
    var_dump($mail->getTo());
  }
}