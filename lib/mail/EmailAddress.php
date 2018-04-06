<?php namespace SendGrid\Mail;

class EmailAddress implements \JsonSerializable
{
    private $name;
    private $email;

    public function __construct(
        $emailAddress,
        $name = null,
        $substitutions = null,
        $subject = null
    ) {
        $this->email = $emailAddress;
        $this->name  = $name;
        $this->substitutions = $substitutions;
        $this->subject = $subject;
    }

    public function getEmail()
    {
        return $this->getEmailAddress();
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

    public function getSubstitions()
    {
        return $this->substitutions;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'name'  => $this->getName(),
                'email' => $this->getEmail()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
