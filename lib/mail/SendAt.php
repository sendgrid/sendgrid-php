<?php namespace SendGrid\Mail;

class SendAt implements \JsonSerializable
{
    private $send_at;

    public function __construct($send_at=null)
    {
        if(isset($send_at)) $this->setSendAt($send_at);
    }

    public function getSendAt()
    {
        return $this->send_at;
    }

    public function setSendAt($send_at)
    {
        $this->send_at = $send_at;
    }

    public function jsonSerialize()
    {
        return $this->getSendAt();
    }
}
