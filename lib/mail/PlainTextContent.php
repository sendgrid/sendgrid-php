<?php namespace SendGrid\Mail;

class PlainTextContent extends Content
{
    public function __construct($value)
    {
        parent::__construct(self::TYPE_TEXT, $value);
    }
}
