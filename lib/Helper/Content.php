<?php

namespace SendGrid\Helper;

/**
 * Class Content
 * @package SendGrid\Helper
 */
class Content implements \jsonSerializable
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
        $this->value = $value;
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
        $this->value = $value;
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
                'type' => $this->getType(),
                'value' => $this->getValue()
            ]
        );
    }
}
