<?php
/**
 * This helper builds the MailSettings object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

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
    /** @var $bypass_bounce_management BypassBounceManagement object */
    private $bypass_bounce_management;
    /** @var $bypass_list_management BypassListManagement object */
    private $bypass_list_management;
    /** @var $bypass_spam_management BypassSpamManagement object */
    private $bypass_spam_management;
    /** @var $bypass_unsubscribe_management BypassUnsubscribeManagement object */
    private $bypass_unsubscribe_management;
    /** @var $footer Footer object */
    private $footer;
    /** @var $sandbox_mode SandBoxMode object */
    private $sandbox_mode;
    /** @var $spam_check SpamCheck object */
    private $spam_check;

    /**
     * Optional constructor
     *
     * @param BccSettings|null                 $bcc_settings                  BccSettings object
     * @param BypassBounceManagement|null      $bypass_bounce_management      BypassBounceManagement
     *                                                                        object
     * @param BypassListManagement|null        $bypass_list_management        BypassListManagement
     *                                                                        object
     * @param BypassSpamManagement|null        $bypass_spam_management        BypassSpamManagement
     *                                                                        object
     * @param BypassUnsubscribeManagement|null $bypass_unsubscribe_management BypassUnsubscribeManagement
     *                                                                        object
     * @param Footer|null                      $footer                        Footer object
     * @param SandBoxMode|null                 $sandbox_mode                  SandBoxMode object
     * @param SpamCheck|null                   $spam_check                    SpamCheck object
     * @throws \SendGrid\Mail\TypeException
     */
    public function __construct(
        $bcc_settings = null,
        $bypass_bounce_management = null,
        $bypass_list_management = null,
        $bypass_spam_management = null,
        $bypass_unsubscribe_management = null,
        $footer = null,
        $sandbox_mode = null,
        $spam_check = null
    ) {
        if (isset($bcc_settings)) {
            $this->setBccSettings($bcc_settings);
        }
        if (isset($bypass_bounce_management)) {
            $this->setBypassBounceManagement($bypass_bounce_management);
        }
        if (isset($bypass_list_management)) {
            $this->setBypassListManagement($bypass_list_management);
        }
        if (isset($bypass_spam_management)) {
            $this->setBypassSpamManagement($bypass_spam_management);
        }
        if (isset($bypass_unsubscribe_management)) {
            $this->setBypassUnsubscribeManagement($bypass_unsubscribe_management);
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
     * @param string|null      $email  The email address that you would like
     *                                 to receive the BCC
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setBccSettings($enable, $email = null)
    {
        if ($enable instanceof BccSettings) {
            $bcc = $enable;
            $this->bcc = $bcc;
            return;
        }
        Assert::boolean(
            $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\BccSettings or a boolean.'
        );
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
     * Set bypass bounce management settings on a MailSettings object
     *
     * @param BypassBounceManagement|bool $enable The BypassBounceManagement
     *                                            object or an indication
     *                                            if the setting is enabled
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setBypassBounceManagement($enable)
    {
        if ($enable instanceof BypassBounceManagement) {
            $bypass_bounce_management = $enable;
            $this->bypass_bounce_management = $bypass_bounce_management;
            return;
        }
        Assert::boolean(
            $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\BypassBounceManagement
                                                or a boolean.'
        );
        $this->bypass_bounce_management = new BypassBounceManagement($enable);
    }

    /**
     * Set bypass list management settings on a MailSettings object
     *
     * @param BypassListManagement|bool $enable The BypassListManagement
     *                                          object or an indication
     *                                          if the setting is enabled
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setBypassListManagement($enable)
    {
        if ($enable instanceof BypassListManagement) {
            $bypass_list_management = $enable;
            $this->bypass_list_management = $bypass_list_management;
            return;
        }
        Assert::boolean(
            $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\BypassListManagement
                                                or a boolean.'
        );
        $this->bypass_list_management = new BypassListManagement($enable);
    }

    /**
     * Set bypass spam management settings on a MailSettings object
     *
     * @param BypassSpamManagement|bool $enable The BypassSpamManagement
     *                                          object or an indication
     *                                          if the setting is enabled
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setBypassSpamManagement($enable)
    {
        if ($enable instanceof BypassSpamManagement) {
            $bypass_spam_management = $enable;
            $this->bypass_spam_management = $bypass_spam_management;
            return;
        }
        Assert::boolean(
            $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\BypassSpamManagement or a boolean.'
        );
        $this->bypass_spam_management = new BypassSpamManagement($enable);
    }

    /**
     * Set bypass unsubscribe management settings on a MailSettings object
     *
     * @param BypassUnsubscribeManagement|bool $enable The BypassUnsubscribeManagement
     *                                                 object or an indication
     *                                                 if the setting is enabled
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setBypassUnsubscribeManagement($enable)
    {
        if ($enable instanceof BypassUnsubscribeManagement) {
            $bypass_unsubscribe_management = $enable;
            $this->bypass_unsubscribe_management = $bypass_unsubscribe_management;
            return;
        }
        Assert::boolean(
            $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\BypassUnsubscribeManagement
                                                or a boolean.'
        );
        $this->bypass_unsubscribe_management = new BypassUnsubscribeManagement($enable);
    }

    /**
     * Retrieve bypass bounce management settings from a MailSettings object
     *
     * @return BypassBounceManagement
     */
    public function getBypassBounceManagement()
    {
        return $this->bypass_bounce_management;
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
     * Retrieve bypass spam management settings from a MailSettings object
     *
     * @return BypassSpamManagement
     */
    public function getBypassSpamManagement()
    {
        return $this->bypass_spam_management;
    }

    /**
     * Retrieve bypass unsubscribe management settings from a MailSettings object
     *
     * @return BypassUnsubscribeManagement
     */
    public function getBypassUnsubscribeManagement()
    {
        return $this->bypass_unsubscribe_management;
    }

    /**
     * Set the footer settings on a MailSettings object
     *
     * @param Footer|bool $enable The Footer object or an indication
     *                            if the setting is enabled
     * @param string|null $text   The plain text content of your footer
     * @param string|null $html   The HTML content of your footer
     *
     * @throws TypeException
     */
    public function setFooter($enable, $text = null, $html = null)
    {
        if ($enable instanceof Footer) {
            $footer = $enable;
            $this->footer = $footer;
            return;
        }
        $this->footer = new Footer($enable, $text, $html);
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
     * @throws TypeException
     */
    public function setSandboxMode($enable)
    {
        if ($enable instanceof SandBoxMode) {
            $sandbox_mode = $enable;
            $this->sandbox_mode = $sandbox_mode;
            return;
        }
        Assert::boolean(
            $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\SandBoxMode or a boolean.'
        );
        $this->sandbox_mode = new SandBoxMode($enable);
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
     *
     * @throws TypeException
     */
    public function enableSandboxMode()
    {
        $this->setSandboxMode(true);
    }

    /**
     * Disable sandbox mode on a MailSettings object
     *
     * @throws TypeException
     */
    public function disableSandboxMode()
    {
        $this->setSandboxMode(false);
    }

    /**
     * Set spam check settings on a MailSettings object
     *
     * @param SpamCheck|bool $enable      The SpamCheck object or an
     *                                    indication if the setting is enabled
     * @param int            $threshold   The threshold used to determine if your
     *                                    content qualifies as spam on a scale
     *                                    from 1 to 10, with 10 being most strict,
     *                                    or most
     * @param string         $post_to_url An Inbound Parse URL that you would like
     *                                    a copy of your email along with the spam
     *                                    report to be sent to
     *
     * @throws TypeException
     */
    public function setSpamCheck($enable, $threshold = null, $post_to_url = null)
    {
        if ($enable instanceof SpamCheck) {
            $spam_check = $enable;
            $this->spam_check = $spam_check;
            return;
        }
        Assert::boolean(
            $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\SpamCheck or a boolean.'
        );
        $this->spam_check = new SpamCheck($enable, $threshold, $post_to_url);
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
     * Return an array representing a MailSettings object for the Twilio SendGrid API
     *
     * @return null|array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(
            [
                'bcc' => $this->getBccSettings(),
                'bypass_bounce_management' => $this->getBypassBounceManagement(),
                'bypass_list_management' => $this->getBypassListManagement(),
                'bypass_spam_management' => $this->getBypassSpamManagement(),
                'bypass_unsubscribe_management' => $this->getBypassUnsubscribeManagement(),
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
