<?php

class ASMSuppressions
{
  protected
    $base_endpoint,
    $endpoint,
    $client;
  
  public function __construct($client, $options=NULL)
  {
    $this->base_endpoint = "/v3/asm";
    $this->endpoint = "/v3/asm";
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
  
  public function get($group_id=Null){
    if ($group_id != Null ) {
      $this->endpoint = $this->base_endpoint . "/groups/" . $group_id . "/suppressions"; 
    }
    return $this->client->getRequest($this);
  }
}