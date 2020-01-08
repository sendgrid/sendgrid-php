<?php
/**
 * This helper builds the ClickTracking object for a /mail/send API call
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
 * This class is used to construct a ClickTracking object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class ClickTracking implements \JsonSerializable
{
    /** @var $enable bool Indicates if this setting is enabled */
    private $enable;
    /* @var $enable_text bool Indicates if this setting should be included in the text/plain portion of your email */
    private $enable_text;

    /**
     * Optional constructor
     *
     * @param bool|null $enable Indicates if this setting is enabled
     * @param bool|null $enable_text Indicates if this setting should be
     *                               included in the text/plain portion of
     *                               your email
     */
    public function __construct($enable = null, $enable_text = null)
    {
        if (isset($enable)) {
            $this->setEnable($enable);
        }
        if (isset($enable_text)) {
            $this->setEnableText($enable_text);
        }
    }

    /**
     * Update the enable setting on a ClickTracking object
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
     * Retrieve the enable setting on a ClickTracking object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Update the enable text setting on a ClickTracking object
     *
     * @param bool $enable_text Indicates if this setting is enabled
     * 
     * @throws TypeException
     */ 
    public function setEnableText($enable_text)
    {
        if (!is_bool($enable_text)) {
            throw new TypeException('$enable_text must be of type bool');
        }
        $this->enable_text = $enable_text;
    }

    /**
     * Retrieve the enable_text setting on a ClickTracking object
     *
     * @return bool
     */
    public function getEnableText()
    {
        return $this->enable_text;
    }

    /**
     * Return an array representing a ClickTracking object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'enable_text' => $this->getEnableText()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
