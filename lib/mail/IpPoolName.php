<?php namespace SendGrid\Mail;

class IpPoolName implements \JsonSerializable
{
    private $ip_pool_name;

    public function __construct(string $ip_pool_name=null)
    {
        if(isset($ip_pool_name)) $this->setIpPoolName($ip_pool_name);
    }

    public function getIpPoolName()
    {
        return $this->ip_pool_name;
    }

    public function setIpPoolName(string $ip_pool_name)
    {
        $this->ip_pool_name = $ip_pool_name;
    }

    public function jsonSerialize()
    {
        return $this->getIpPoolName();
    }
}