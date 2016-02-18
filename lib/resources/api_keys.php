<?php

class APIKeys
{
  protected
    $name,
    $scopes,
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
    $this->endpoint = $this->base_endpoint;
    return $this->client->getRequest($this);
  }
  
  public function post($name, $scopes = NULL){
    $this->endpoint = $this->base_endpoint;
    $data = array(
      'name' => $name,
    );
    if ($scopes)
        $data["scopes"] = $scopes;
    
    return $this->client->postRequest($this, $data);
  }
  
  public function put($api_key_id, $name, $scopes){
    $this->endpoint = $this->base_endpoint;
    $data = array(
      'name' => $name,
      'scopes' => $scopes
    );
    $this->endpoint = $this->base_endpoint . "/" . $api_key_id;
    return $this->client->putRequest($this, $data);
  }
  
  public function patch($api_key_id, $name){
    $this->endpoint = $this->base_endpoint;
    $data = array(
      'name' => $name,
    );
    $this->endpoint = $this->base_endpoint . "/" . $api_key_id; 
    return $this->client->patchRequest($this, $data);
  }  
  
  public function delete($api_key_id){
    $this->endpoint = $this->base_endpoint;
    $this->endpoint = $this->base_endpoint . "/" . $api_key_id;
    return $this->client->deleteRequest($this);
  }
}