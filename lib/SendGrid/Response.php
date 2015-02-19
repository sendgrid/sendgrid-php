<?php

namespace SendGrid;

class Response
{

  public $code,
         $headers,
         $raw_body,
         $body;

  public function __construct($code, $headers, $raw_body, $body)
  {
    $this->code     = $code;
    $this->headers  = $headers;
    $this->raw_body = $raw_body;
    $this->body     = $body;
  }
}
