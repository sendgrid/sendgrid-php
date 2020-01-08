<?php
/**
 * This helper builds the BypassListManagement object for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a BypassListManagement object for
 * the /mail/send API call
 *
 * Allows you to bypass all unsubscribe groups and suppressions to
 * ensure that the email is delivered to every single recipient. This
 * should only be used in emergencies when it is absolutely necessary
 * that every recipient receives your email
 *
 * @package SendGrid\Mail
 */
class BypassListManagement implements \JsonSerializable
{
    /** @var $enable bool Indicates if this setting is enabled */
    private $enable;

    /**
     * Optional constructor
     *
     * @param bool|null $enable Indicates if this setting is enabled
     */
    public function __construct($enable = null)
    {
        if (isset($enable)) {
            $this->setEnable($enable);
        }
    }

    /**
     * Update the enable setting on a BypassListManagement object
     *
     * @param bool $enable Indicates if this setting is enabled
     * 
     * @throws TypeException
     */ 
    public function setEnable($enable)
    {
        if (!is_bool($enable)) {
            throw new TypeException('$enable must be of type bool.');
        }
        $this->enable = $enable;
    }

    /**
     * Retrieve the enable setting on a BypassListManagement object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Return an array representing a BypassListManagement object for
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
