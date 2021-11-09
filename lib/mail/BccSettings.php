<?php
/**
 * This helper builds the BccSettings object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a BccSettings object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class BccSettings implements \JsonSerializable
{
    /** @var $enable bool Indicates if this setting is enabled */
    private $enable;
    /** @var $email string The email address that you would like to receive the BCC */
    private $email;

    /**
     * Optional constructor
     *
     * @param bool|null   $enable Indicates if this setting is enabled
     * @param string|null $email  The email address that you would like
     *                            to receive the BCC
     * @throws \SendGrid\Mail\TypeException
     */
    public function __construct($enable = null, $email = null)
    {
        if (isset($enable)) {
            $this->setEnable($enable);
        }
        if (isset($email)) {
            $this->setEmail($email);
        }
    }

    /**
     * Update the enable setting on a BccSettings object
     *
     * @param bool $enable Indicates if this setting is enabled
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setEnable($enable)
    {
        Assert::boolean($enable, 'enable');

        $this->enable = $enable;
    }

    /**
     * Retrieve the enable setting on a BccSettings object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Add the email setting on a BccSettings object
     *
     * @param string $email The email address that you would like
     *                      to receive the BCC
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setEmail($email)
    {
        Assert::email($email, 'email');

        $this->email = $email;
    }

    /**
     * Retrieve the email setting on a BccSettings object
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Return an array representing a BccSettings object for the Twilio SendGrid API
     *
     * @return null|array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'email' => $this->getEmail()
            ],
            static function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
