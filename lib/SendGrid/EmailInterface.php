<?php

namespace SendGrid;

interface EmailInterface {
  public function send(Email $email);  
}
