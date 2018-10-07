<?php

namespace SendGrid;
class Ips
{
	private $sendGrid;
	
	public function __construct(SendGrid $sendGrid)
	{
		$this->sendGrid = $sendGrid;
	}
	
	public function getAll()
	{
		$response = $this->sendGrid->client->ips()->get();
		return $response->body();
	}
	
	public function getAssigned()
	{
		$response = $this->sendGrid->client->ips()->assigned()->get();
		return $response->body();
	}
	
	public function getUnassigned()
	{
		$allIps = $this->getAll();
		$ips = json_decode($allIps,true);
		$unassigned_ips=array();
		foreach($ips as $ip){
			if (empty($ip['subusers'])) {
                $unassigned_ips[] = $ip['ip'];
				//array_push($unassigned_ips,$ip['ip']);
			}
		}
		return $unassigned_ips;
	}
}
