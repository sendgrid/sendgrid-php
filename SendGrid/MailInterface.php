<?php

namespace SendGrid;

interface MailInterface
{
  public function send(Mail $mail);  
  
  
}