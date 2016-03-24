<?php

class Lists
{
    protected
        $name,
        $base_endpoint,
        $endpoint,
        $client;

    public function __construct($client, $options=NULL)
    {
        $this->name = NULL;
        $this->base_endpoint = "/v3/contactdb/lists";
        $this->endpoint = "/v3/contactdb/lists";
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

    public function create($name)
    {
        $this->endpoint = $this->base_endpoint;

        $data = array(
            'name' => $name
        );

        return $this->client->postRequest($this, $data);
    }

    public function get($list_id=null)
    {
        $this->endpoint = $this->base_endpoint;

        if(!is_null($list_id))
            $this->endpoint .= "/$list_id";

        return $this->client->getRequest($this);
    }

    public function getRecipients($list_id, $page=1, $page_size=100)
    {
        $this->endpoint = $this->base_endpoint."/$list_id/recipients?page_size=$page_size&page=$page";

        return $this->client->getRequest($this);
    }

    public function addRecipient($list_id, $recipient_id)
    {
        $this->endpoint = $this->base_endpoint."/$list_id/recipients/$recipient_id";

        $data = array(
            'list_id' => $list_id,
            'recipient_id' => $recipient_id
        );

        return $this->client->postRequest($this, $data);
    }

    public function addRecipients($list_id, $recipient_ids=array())
    {
        $this->endpoint = $this->base_endpoint."/$list_id/recipients";

        return $this->client->postRequest($this, $recipient_ids);
    }

    public function removeRecipient($list_id, $recipient_id)
    {
        $this->endpoint = $this->base_endpoint."/$list_id/recipients/$recipient_id";

        return $this->client->deleteRequest($this);
    }

    public function patch($list_id, $name)
    {
        $this->endpoint = $this->base_endpoint."/$list_id";

        $data = array(
            'name' => $name
        );

        return $this->client->patchRequest($this, $data);
    }

    public function delete($data){
        $this->endpoint = $this->base_endpoint;
        return $this->client->deleteRequest($this, $data);
    }

}