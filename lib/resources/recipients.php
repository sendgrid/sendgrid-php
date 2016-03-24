<?php

class Recipients
{
    protected
        $name,
        $base_endpoint,
        $endpoint,
        $client;

    public function __construct($client, $options=NULL)
    {
        $this->name = NULL;
        $this->base_endpoint = "/v3/contactdb/recipients";
        $this->endpoint = "/v3/contactdb/recipients";
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

    public function getName(){
        return $this->name;
    }

    public function get($page=1, $page_size=100)
    {
        $this->endpoint = $this->base_endpoint."?page_size=$page_size&page=$page";

        return $this->client->getRequest($this);
    }

    public function add($data=array())
    {
        $this->endpoint = $this->base_endpoint;

        return $this->client->postRequest($this, $data);
    }

    public function patch($data=array())
    {
        $this->endpoint = $this->base_endpoint;

        return $this->client->patchRequest($this, $data);
    }

    public function delete($data){
        $this->endpoint = $this->base_endpoint;
        return $this->client->deleteRequest($this, $data);
    }

}