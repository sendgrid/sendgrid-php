<?php

namespace SendGrid\Mail\Optional;

final class Section implements \JsonSerializable
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $key
     * @param string $value
     */
    public function __construct($key, $value)
    {
        $this->validateScalar($key, $value);
        $this->key   = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            $this->key => $this->value
        ];
    }

    /**
     * @param string $key
     * @param string $value
     */
    private function validateScalar($key, $value)
    {
        if (!is_string($key) || !is_string($value)) {
            throw new \InvalidArgumentException('Arguments must be string');
        }
    }
}
