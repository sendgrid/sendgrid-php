<?php

class GlobalStats
{
  protected
    $base_endpoint,
    $endpoint,
    $client;
  
  public function __construct($client, $options=NULL)
  {
    $this->name = NULL;
    $this->base_endpoint = "/v3/stats";
    $this->endpoint = "/v3/stats";
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
  
  public function get($start_date, $end_date=Null, $aggregated_by=Null){
    $this->endpoint = $this->base_endpoint . "?start_date=" . $start_date;
    if($end_date != Null){
      $this->endpoint = $this->endpoint . "&end_date=" . $end_date; 
    }
    if($aggregated_by != Null){
      $this->endpoint = $this->endpoint . "&aggregated_by=" . $aggregated_by; 
    }
    return $this->client->getRequest($this);
  }
}