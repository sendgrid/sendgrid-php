<?php namespace SendGrid\Mail;

class Subject implements \JsonSerializable
{
    private $subject;

    public function __construct($subject=null)
    {
        if(isset($subject)) $this->setSubject($subject);
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
