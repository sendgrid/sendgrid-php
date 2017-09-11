<?php

namespace SendGrid\Mail\Optional;

final class Category implements \JsonSerializable
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->validateScalar($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->value;
    }

    /**
     * @param $value
     */
    private function validateScalar($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('Argument must be string');
        }
    }
}
