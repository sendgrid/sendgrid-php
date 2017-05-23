<?php

namespace SendGrid\Helper\Mail;

/**
 * Class Content
 * @package SendGrid\Helper
 */
class Content implements \JsonSerializable
{
    private $type;
    private $value;

    /**
     * Content constructor.
     * @param $type
     * @param $value
     */
    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setValue($value)
    {
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        return $this;
    }

    public function getValue()
    {
        return $this->value;
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
