<?php namespace SendGrid\Helpers\Mail\Model;

class EmailAddress
{
    public $email;
    public $name;

    public function __construct($emailAddress, $name = null)
    {
        $this->email = $emailAddress;
        $this->name  = $name;
    }

    public function getEmailAddress()
    {
        return $this->email;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->email = $emailAddress;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
