<?php
/**
 * This helper builds the BypassUnsubscribeManagement object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a BypassUnsubscribeManagement object for
 * the /mail/send API call
 *
 * Allows you to bypass the global unsubscribe list to ensure that the email is delivered
 * to recipients. Bounce and spam report lists will still be checked; addresses on these
 * other lists will not receive the message. This filter applies only to global unsubscribes
 * and will not bypass group unsubscribes.
 *
 * This filter cannot be combined with the bypass_list_management filter.
 *
 * @package SendGrid\Mail
 */
class BypassUnsubscribeManagement implements \JsonSerializable
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
     * Update the enable setting on a BypassUnsubscribeManagement object
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
     * Retrieve the enable setting on a BypassUnsubscribeManagement object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Return an array representing a BypassUnsubscribeManagement object for
     * the SendGrid API
     *
     * @return null|array
     */
    #[\ReturnTypeWillChange]
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
