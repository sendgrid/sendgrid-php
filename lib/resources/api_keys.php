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
  
  public function getName(){
    return $this->name;
  }
  
  public function setEndpoint($endpoint){
    $this->endpoint = $endpoint;
  }
  
  public function get(){
    return $this->client->getRequest($this);
  }
  
  public function post($name){
    $data = array(
      'name' => $name,
    );
    return $this->client->postRequest($this, $data);
  }
  
  public function patch($api_key_id, $name){
    $data = array(
      'name' => $name,
    );
    $this->endpoint = $this->base_endpoint . "/" . $api_key_id; 
    return $this->client->patchRequest($this, $data);
  }  
  
  public function delete($api_key_id){
    $this->endpoint = $this->base_endpoint . "/" . $api_key_id;
    return $this->client->deleteRequest($this);
  }
}