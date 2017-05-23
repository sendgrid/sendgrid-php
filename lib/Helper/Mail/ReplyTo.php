<?php

namespace SendGrid\Helper\Mail;

/**
 * Class ReplyTo
 * @package SendGrid
 */
class ReplyTo implements \JsonSerializable
{
    private $email;

    /**
     * ReplyTo constructor.
     * @param $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'email' => $this->getEmail()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
