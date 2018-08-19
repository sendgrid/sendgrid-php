<?php
/**
 * This helper builds the MailSettings object for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a MailSettings object for the /mail/send API call
 *
 * A collection of different mail settings that you can use to specify how you would
 * like this email to be handled
 *
 * @package SendGrid\Mail
 */
class MailSettings implements \JsonSerializable
{
    /** @var $bcc Bcc object */
    private $bcc;
    /** @var $bypass_list_management BypassListManagement object */
    private $bypass_list_management;
    /** @var $footer Footer object */
    private $footer;
    /** @var $sandbox_mode SandBoxMode object */
    private $sandbox_mode;
    /** @var $spam_check SpamCheck object */
    private $spam_check;

    /**
     * Optional constructor
     *
     * @param BccSettings|null $bcc_settings BccSettings object
     * @param BypassListManagement|null $bypass_list_management BypassListManagement
     *                                                          object
     * @param Footer|null $footer Footer object
     * @param SandBoxMode|null $sandbox_mode SandBoxMode object
     * @param SpamCheck|null $spam_check SpamCheck object
     */
    public function __construct(
        $bcc_settings = null,
        $bypass_list_management = null,
        $footer = null,
        $sandbox_mode = null,
        $spam_check = null
    ) {
        if (isset($bcc_settings)) {
            $this->setBccSettings($bcc_settings);
        }
        if (isset($bypass_list_management)) {
            $this->setBypassListManagement($bypass_list_management);
        }
        if (isset($footer)) {
            $this->setFooter($footer);
        }
        if (isset($sandbox_mode)) {
            $this->setSandboxMode($sandbox_mode);
        }
        if (isset($spam_check)) {
            $this->setSpamCheck($spam_check);
        }
    }

    /**
     * Set the bcc settings on a MailSettings object
     *
     * @param BccSettings|bool $enable The BccSettings object or an indication
     *                                 if the setting is enabled
     * @param string|null $email The email address that you would like
     *                                 to receive the BCC
     * 
     * @throws TypeException
     */ 
    public function setBccSettings($enable, $email = null)
    {
        if ($enable instanceof BccSettings) {
            $bcc = $enable;
            $this->bcc = $bcc;
            return;
        }
        if (!is_bool($enable)) {
            throw new TypeException(
                '$enable must be an instance of SendGrid\Mail\BccSettings or of type bool.'
            );
        }
        $this->bcc = new BccSettings($enable, $email);
    }

    /**
     * Retrieve the bcc settings from a MailSettings object
     *
     * @return Bcc
     */
    public function getBccSettings()
    {
        return $this->bcc;
    }

    /**
     * Set bypass list management settings on a MailSettings object
     *
     * @param BypassListManagement|bool $enable The BypassListManagement
     *                                          object or an indication
     *                                          if the setting is enabled
     * 
     * @throws TypeException
     */
    public function setBypassListManagement($enable)
    {
        if ($enable instanceof BypassListManagement) {
            $bypass_list_management = $enable;
            $this->bypass_list_management = $bypass_list_management;
            return;
        }
        if (!is_bool($enable)) {
            throw new TypeException(
                '$enable must be an instance of SendGrid\Mail\BypassListManagement or of type bool.'
            );
        }
        $this->bypass_list_management = new BypassListManagement($enable);
        return;
    }

    /**
     * Retrieve bypass list management settings from a MailSettings object
     *
     * @return BypassListManagement
     */
    public function getBypassListManagement()
    {
        return $this->bypass_list_management;
    }

    /**
     * Set the footer settings on a MailSettings object
     *
     * @param Footer|bool $enable The Footer object or an indication
     *                            if the setting is enabled
     * @param string|null $text The plain text content of your footer
     * @param string|null $html The HTML content of your footer
     *
     * @return null
     */
    public function setFooter($enable, $text = null, $html = null)
    {
        if ($enable instanceof Footer) {
            $footer = $enable;
            $this->footer = $footer;
            return;
        }
        $this->footer = new Footer($enable, $text, $html);
        return;
    }

    /**
     * Retrieve the footer settings from a MailSettings object
     *
     * @return Footer
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Set sandbox mode settings on a MailSettings object
     *
     * @param SandBoxMode|bool $enable The SandBoxMode object or an
     *                                 indication if the setting is enabled
     *
     * @return null
     */
    public function setSandboxMode($enable)
    {
        if ($enable instanceof SandBoxMode) {
            $sandbox_mode = $enable;
            $this->sandbox_mode = $sandbox_mode;
            return;
        }
        $this->sandbox_mode = new SandBoxMode($enable);
        return;
    }

    /**
     * Retrieve sandbox mode settings on a MailSettings object
     *
     * @return SandBoxMode
     */
    public function getSandboxMode()
    {
        return $this->sandbox_mode;
    }

    /**
     * Enable sandbox mode on a MailSettings object
     */
    public function enableSandboxMode()
    {
        $this->setSandboxMode(true);
    }

    /**
     * Disable sandbox mode on a MailSettings object
     */
    public function disableSandboxMode()
    {
        $this->setSandboxMode(false);
    }

    /**
     * Set spam check settings on a MailSettings object
     *
     * @param SpamCheck|bool $enable The SpamCheck object or an
     *                                    indication if the setting is enabled
     * @param int $threshold The threshold used to determine if your
     *                                    content qualifies as spam on a scale
     *                                    from 1 to 10, with 10 being most strict,
     *                                    or most
     * @param string $post_to_url An Inbound Parse URL that you would like
     *                                    a copy of your email along with the spam
     *                                    report to be sent to
     *
     * @return null
     */
    public function setSpamCheck($enable, $threshold = null, $post_to_url = null)
    {
        if ($enable instanceof SpamCheck) {
            $spam_check = $enable;
            $this->spam_check = $spam_check;
            return;
        }
        $this->spam_check = new SpamCheck($enable, $threshold, $post_to_url);
        return;
    }

    /**
     * Retrieve spam check settings from a MailSettings object
     *
     * @return SpamCheck
     */
    public function getSpamCheck()
    {
        return $this->spam_check;
    }

    /**
     * Return an array representing a MailSettings object for the SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'bcc' => $this->getBccSettings(),
                'bypass_list_management' => $this->getBypassListManagement(),
                'footer' => $this->getFooter(),
                'sandbox_mode' => $this->getSandboxMode(),
                'spam_check' => $this->getSpamCheck()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
