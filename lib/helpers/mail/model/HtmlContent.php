<?php namespace SendGrid\Helpers\Mail\Model;

class HtmlContent extends Content
{
    public function __construct($value)
    {
        parent::__construct(self::TYPE_HTML, $value);
    }
}
