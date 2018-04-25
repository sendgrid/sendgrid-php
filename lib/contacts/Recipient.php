<?php namespace SendGrid\Contacts;
/**
 * Class for creating a recipient
 */
class Recipient implements \JsonSerializable
{
    private $firstName;
    private $lastName;
    private $email;

    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'email' => $this->getEmail(),
                'first_name' => $this->getFirstName(),
                'last_name' => $this->getLastName()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
