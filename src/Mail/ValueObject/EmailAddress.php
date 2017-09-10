<?php

namespace SendGrid\Mail\ValueObject;

use SendGrid\Mail\Exception\InvalidEmailAddressException;

class EmailAddress implements \JsonSerializable
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param string $address
     * @param string|null $name
     * @throws \Exception
     */
    public function __construct($address, $name = null)
    {
        $this->validateScalar($address, $name);
        $this->address = $this->valid($address);
        $this->name    = $name;
    }

    /**
     * @param $address
     * @return string
     * @throws InvalidEmailAddressException
     */
    private function valid($address)
    {
        if ($this->isValid($address)) {
            return $address;
        }
        throw new InvalidEmailAddressException($address);
    }

    /**
     * @param $value
     * @return bool
     */
    private function isValid($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    /**
     * @param $address
     * @param $name
     * @throws \Exception
     * @return void
     */
    private function validateScalar($address, $name)
    {
        if (!is_string($address) || null !== $name && !is_string($name)) {
            throw new \Exception('Arguments must be string');
        }
    }

    /**
     * @return array|string
     */
    public function jsonSerialize()
    {
        if (null !== $this->name) {
            return [
                'name'  => $this->name,
                'email' => $this->address
            ];
        }
        return $this->address;
    }
}
