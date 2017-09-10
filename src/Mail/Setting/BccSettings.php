<?php

namespace SendGrid\Mail\Setting;

use SendGrid\Mail\ValueObject\EmailAddress;

final class BccSettings implements \JsonSerializable
{
    /**
     * @var bool
     */
    private $enable;

    /**
     * @var EmailAddress
     */
    private $emailAddress;

    /**
     * @param bool $enable
     * @param EmailAddress $emailAddress
     */
    public function __construct($enable, EmailAddress $emailAddress)
    {
        $this->validateBoolean($enable);
        $this->enable       = $enable;
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'enable' => $this->enable,
            'email'  => $this->emailAddress
        ];
    }

    /**
     * @param $enable
     */
    private function validateBoolean($enable)
    {
        if (!is_bool($enable)) {
            throw new \InvalidArgumentException('Argument must be boolean');
        }
    }
}
