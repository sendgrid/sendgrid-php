<?php

namespace SendGrid\Helper\Mail;

/**
 * Class Email
 * @package SendGrid\Helper
 */
class Email implements \JsonSerializable
{
    private
        $name,
        $email;

    /**
     * Email constructor.
     * @param $name
     * @param $email
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'name' => $this->getName(),
                'email' => $this->getEmail()
            ]
        );
    }
}
