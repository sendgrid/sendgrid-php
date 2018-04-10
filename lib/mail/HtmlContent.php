<?php namespace SendGrid\Mail;

class HtmlContent extends Content
{
    public function __construct($value)
    {
        parent::__construct(MimeType::Html, $value);
    }
}
