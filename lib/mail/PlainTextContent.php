<?php namespace SendGrid\Mail;

class PlainTextContent extends Content
{
    public function __construct($value)
    {
        parent::__construct(MimeType::Text, $value);
    }
}
