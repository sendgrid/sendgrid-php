<?php namespace SendGrid\Mail;

class BccSettings implements \JsonSerializable
{
    private $enable;
    private $email;

    public function __construct($enable=null, $email=null)
    {
        if(isset($enable)) $this->setEnable($enable);
        if(isset($email)) $this->setEmail($email);
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'email'  => $this->getEmail()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
