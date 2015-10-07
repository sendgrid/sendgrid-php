<?php

class APIKeys
{
  protected
    $name,
    $base_endpoint,
    $endpoint,
    $client;
  
  public function __construct($client, $options=NULL)
  {
    $this->name = NULL;
    $this->base_endpoint = "/v3/api_keys";
    $this->endpoint = "/v3/api_keys";
    $this->client = $client;
  }
  
  public function getBaseEndpoint(){
    return $this->base_endpoint;
  }
  
  public function getEndpoint(){
    return $this->endpoint;
  }
  
  public function setEndpoint($endpoint){
    $this->endpoint = $endpoint;
  }
  
  public function get(){
    return $this->client->getRequest($this);
  }
}