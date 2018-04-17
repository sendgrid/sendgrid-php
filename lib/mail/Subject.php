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
        return mb_convert_encoding($this->subject, 'UTF-8', 'UTF-8');
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
