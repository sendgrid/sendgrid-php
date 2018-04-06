<?php namespace SendGrid\Mail;

class Subject implements \JsonSerializable
{
    public $subject;

    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function jsonSerialize()
    {
        return $this->getSubject();
    }
}
