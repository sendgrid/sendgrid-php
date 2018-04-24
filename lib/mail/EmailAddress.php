<?php namespace SendGrid\Mail;

class EmailAddress implements \JsonSerializable
{
    private $name;
    private $email;

    public function __construct(
        $emailAddress=null,
        $name=null,
        $substitutions=null,
        $subject=null
    ) {
        if(isset($emailAddress)) $this->setEmailAddress($emailAddress);
        if(isset($name)) $this->setName($name);
        if(isset($substitutions)) $this->setSubstitutions($substitutions);
        if(isset($subject)) $this->setSubject($subject);
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
