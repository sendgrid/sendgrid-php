<?php

class Templates
{
    protected
        $name,
        $base_endpoint,
        $endpoint,
        $client;

    public function __construct($client, $options=NULL)
    {
        $this->name = NULL;
        $this->base_endpoint = "/v3/templates";
        $this->endpoint = "/v3/templates";
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

    public function get($template_id = NULL){
        $this->endpoint = $this->base_endpoint;
        if (!is_null($template_id)) {
            $this->endpoint .= '/' . $template_id;
        }
        return $this->client->getRequest($this);
    }

    public function post($name){
        $this->endpoint = $this->base_endpoint;
        $data = array(
            'name' => $name,
        );

        return $this->client->postRequest($this, $data);
    }

    public function patch($template_id, $name){
        $this->endpoint = $this->base_endpoint . "/" . $template_id;
        $data = array(
            'name' => $name,
        );
        return $this->client->patchRequest($this, $data);
    }

    public function delete($template_id){
        $this->endpoint = $this->base_endpoint . "/" . $template_id;
        return $this->client->deleteRequest($this);
    }
}