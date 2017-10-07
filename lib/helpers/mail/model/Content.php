<?php namespace SendGrid\Helpers\Mail\Model;

class Content
{
    const TYPE_TEXT = 'text/plain';
    const TYPE_HTML = 'text/html';

    public $type;
    public $value;

    public function __construct($type, $value)
    {
        $this->type  = $type;
        $this->value = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}
