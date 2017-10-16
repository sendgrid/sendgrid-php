<?php

namespace SendGrid;
class Ips
{
	private $sg;
	
	public function __construct($sg)
	{
		$this->sg = $sg;
	}
	
	public function getAll()
	{
		$response = $sg->client->ips()->get();
		return $response->body();
	}
	
	public function getAssigned()
	{
		$response = $sg->client->ips()->assigned()->get();
		return $response->body();
	}
	
	public function getUnassigned()
	{
		$all_ips = $this->getAll();
		$ips = json_decode($all_ips,true);
		$unassigned_ips=array();
		foreach($ips as $ip){
			if (empty($ip['subusers'])) {
				array_push($unassigned_ips,$ip['ip']);
			}
		}
		return $unassigned_ips;
	}
}

?>
