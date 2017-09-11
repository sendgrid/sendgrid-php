<?php

namespace SendGrid\Mail\Setting;

final class ByPassListManagement implements \JsonSerializable
{
    /**
     * @var bool
     */
    private $enable;

    /**
     * @param bool $enable
     */
    public function __construct($enable)
    {
        $this->validateScalar($enable);
        $this->enable = $enable;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'enable' => $this->enable
        ];
    }

    /**
     * @param $value
     */
    private function validateScalar($value)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('Argument must be boolean');
        }
    }
}
