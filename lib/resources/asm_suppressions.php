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
    if ( $group_id != Null ) {
      $this->endpoint = $this->base_endpoint . "/groups/" . $group_id . "/suppressions"; 
    }
    return $this->client->getRequest($this);
  }
  
  public function post($group_id=Null, $email=Null){
    if ( !is_array($email) ) {
      $email = array($email);
    }
    $this->endpoint = $this->base_endpoint . "/groups/" . $group_id . "/suppressions"; 
    $data = array(
      'recipient_emails' => $email,
    );
    return $this->client->postRequest($this, $data);
  }
  
  public function delete($group_id=Null, $email=Null){
    $this->endpoint = $this->base_endpoint . "/groups/" . $group_id . "/suppressions/" . $email;
    return $this->client->deleteRequest($this);
  }
}