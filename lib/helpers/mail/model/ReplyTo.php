<?php namespace SendGrid\Helpers\Mail\Model;

class ReplyTo implements \JsonSerializable
{
    private $email;
    private $name;

    public function __construct($email, $name = null)
    {
        $this->email = $email;

        if (!is_null($name)) {
            $this->name = $name;
        }
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'email' => $this->getEmail(),
                'name'  => $this->getName(),
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
