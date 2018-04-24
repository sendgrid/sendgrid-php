<?php namespace SendGrid\Mail;

abstract class MimeType
{
    const Text = 'text/plain';
    const Html = 'text/html';
}

class Content implements \JsonSerializable
{
    private $type;
    private $value;

    public function __construct($type=null, $value=null)
    {
        if(isset($type)) $this->setType($type);
        if(isset($value)) $this->setValue($value);
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
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type'  => $this->getType(),
                'value' => $this->getValue()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
