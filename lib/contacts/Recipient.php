<?php
/**
 * This helper builds a recipient for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Contacts
 * @author    Kraig Hufstedler <kraigory@gmail.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Contacts;
/**
 * This class is used to construct a recipient for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Recipient implements \JsonSerializable
{
    /** @var $firstName string First name of the email recipient */
    private $firstName;
    /** @var $lastName string Last name of the email recipient */
    private $lastName;
    /** @var $email string Email address of the recipient */
    private $email;

    /**
     * Create a recipient for the /mail/send API call
     *
     * @param string $firstName First name of the email recipient
     * @param string $lastName Last name of the email recipient
     * @param string $email Email address of the recipient
     */
    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    /**
     * Retrieve the first name of the recipient
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Retrieve the last name of the recipient
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Retrieve the email address of the recipient
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Return an array representing a recipient object for the Twilio SendGrid API
     *
     * @return null|array
     */
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
