<?php namespace SendGrid\Mail;

class Section implements \JsonSerializable
{
    private $key;
    private $value;

    public function __construct($key=null, $value=null)
    {
        if(isset($key)) $this->setKey($key);
        if(isset($value)) $this->setValue($value);
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }
    public function setValue($value)
    {
        $this->value = (string)$value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'key'   => $this->getKey(),
                'value'   => $this->getValue()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}