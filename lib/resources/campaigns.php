<?php

class Campaigns
{
    protected
        $name,
        $base_endpoint,
        $endpoint,
        $client;

    public function __construct($client, $options=NULL)
    {
        $this->name = NULL;
        $this->base_endpoint = "/v3/campaigns";
        $this->endpoint = "/v3/campaigns";
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

    public function get($campaign_id = NULL){
        $this->endpoint = $this->base_endpoint;
        if (!is_null($campaign_id)) {
            $this->endpoint .= '/' . $campaign_id;
        }
        return $this->client->getRequest($this);
    }

    public function create($sender_id, $title=null, $subject=null, $list_ids=array(), $suppression_group_id=null, $html_content=null, $plain_content=null)
    {
        $this->endpoint = $this->base_endpoint;

        $data = array(
            "sender_id" => $sender_id,
            "list_ids" => $list_ids
        );

        if(!is_null($title))
            $data["title"] = $title;

        if(!is_null($subject))
            $data["subject"] = $subject;

        if(!is_null($suppression_group_id))
            $data["suppression_group_id"] = $suppression_group_id;

        if(!is_null($html_content))
            $data["html_content"] = $html_content;

        if(!is_null($plain_content))
            $data["plain_content"] = $plain_content;

        return $this->client->postRequest($this, $data);
    }

    public function patch($campaign_id, $sender_id, $title=null, $subject=null, $list_ids=array(), $suppression_group_id=null, $html_content=null, $plain_content=null)
    {
        $this->endpoint = $this->base_endpoint . "/" . $campaign_id;

        $data = array(
            "sender_id" => $sender_id,
            "list_ids" => $list_ids
        );

        if(!is_null($title))
            $data["title"] = $title;

        if(!is_null($subject))
            $data["subject"] = $subject;

        if(!is_null($suppression_group_id))
            $data["suppression_group_id"] = $suppression_group_id;

        if(!is_null($html_content))
            $data["html_content"] = $html_content;

        if(!is_null($plain_content))
            $data["plain_content"] = $plain_content;

        return $this->client->patchRequest($this, $data);
    }

    public function delete($campaign_id){
        $this->endpoint = $this->base_endpoint . "/" . $campaign_id;
        return $this->client->deleteRequest($this);
    }

    public function send($campaign_id)
    {
        $this->endpoint = $this->base_endpoint."/".$campaign_id."/schedules/now";
        $data = array(
            'campaign_id' => $campaign_id,
        );

        return $this->client->postRequest($this, $data);
    }


}