<?php

namespace SendGrid\Mail\Optional;

final class Subject implements \JsonSerializable
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
     * @param $value
     * @return void
     */
    private function validateScalar($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('Argument must be string');
        }
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->value;
    }
}
