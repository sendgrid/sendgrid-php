<?php
/**
 * This helper builds the request body for a /mail/send API call.
 *
 * PHP version 5.6, 7
 *
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2017 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

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
                'name' => $this->getName(),
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
