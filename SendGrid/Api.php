<?php

namespace SendGrid;

class Api
{
  /** @var string Sendgrid API key with full 'Mail Send' permissions. */
  protected $apiKey;

  public function __construct($apiKey)
  {
    $this->apiKey = $apiKey;
  }

}
