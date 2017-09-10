<?php

namespace SendGrid\Mail\Essential;

final class Content implements \JsonSerializable
{
    const UTF8 = 'UTF-8';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $type
     * @param string $value
     */
    public function __construct($type, $value)
    {
        $this->validateScalar($type, $value);
        $this->type  = $type;
        $this->value = mb_convert_encoding($value, self::UTF8, self::UTF8);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $type
     * @param string $value

     * @return void
     */
    private function validateScalar($type, $value)
    {
        if (!is_string($type) || !is_string($value)) {
            throw new \InvalidArgumentException('Arguments should be strings');
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type'  => $this->type,
            'value' => $this->value
        ];
    }
}
