<?php

namespace SendGrid\Mail\Setting;

final class SandBoxMode implements \JsonSerializable
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
        $this->validateBoolean($enable);
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
     * @param $enable
     */
    private function validateBoolean($enable)
    {
        if (!is_bool($enable)) {
            throw new \InvalidArgumentException;
        }
    }
}
