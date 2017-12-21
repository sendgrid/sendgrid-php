<?php namespace SendGrid\Helpers\Mail\Model;

class Content implements \JsonSerializable
{
    const TYPE_TEXT = 'text/plain';
    const TYPE_HTML = 'text/html';

    public $type;
    public $value;

    public function __construct($type, $value)
    {
        $this->type  = $type;
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
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
