<?php namespace SendGrid\Mail;

class Substitution implements \JsonSerializable
{
    private $key;
    private $value;

    public function __construct(
        $key,
        $value
    ) {
        $this->key = $key;
        $this->value  = $value;
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
        $this->value = $value;
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