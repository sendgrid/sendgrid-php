<?php
/**
 * This helper builds the BypassSpamManagement object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a BypassSpamManagement object for
 * the /mail/send API call
 *
 * Allows you to bypass the spam report list to ensure that the email is delivered to recipients.
 * Bounce and unsubscribe lists will still be checked; addresses on these other lists will not
 * receive the message.
 *
 * This filter cannot be combined with the bypass_list_management filter.
 *
 * @package SendGrid\Mail
 */
class BypassSpamManagement implements \JsonSerializable
{
    /** @var $enable bool Indicates if this setting is enabled */
    private $enable;

    /**
     * Optional constructor
     *
     * @param bool|null $enable Indicates if this setting is enabled
     * @throws \SendGrid\Mail\TypeException
     */
    public function __construct($enable = null)
    {
        if (isset($enable)) {
            $this->setEnable($enable);
        }
    }

    /**
     * Update the enable setting on a BypassSpamManagement object
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
     * Retrieve the enable setting on a BypassSpamManagement object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Return an array representing a BypassSpamManagement object for
     * the SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
