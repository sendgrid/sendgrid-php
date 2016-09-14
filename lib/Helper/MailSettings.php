<?php

namespace SendGrid\Helper;

/**
 * Class MailSettings
 * @package SendGrid\Helper
 */
class MailSettings implements \JsonSerializable
{
    private $bcc;
    private $bypass_list_management;
    private $footer;
    private $sandbox_mode;
    private $spam_check;

    public function setBccSettings($bcc)
    {
        $this->bcc = $bcc;
        return $this;
    }

    public function getBccSettings()
    {
        return $this->bcc;
    }

    public function setBypassListManagement($bypass_list_management)
    {
        $this->bypass_list_management = $bypass_list_management;
        return $this;
    }

    public function getBypassListManagement()
    {
        return $this->bypass_list_management;
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;
        return $this;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function setSandboxMode($sandbox_mode)
    {
        $this->sandbox_mode = $sandbox_mode;
        return $this;
    }

    public function getSandboxMode()
    {
        return $this->sandbox_mode;
    }

    public function setSpamCheck($spam_check)
    {
        $this->spam_check = $spam_check;
        return $this;
    }

    public function getSpamCheck()
    {
        return $this->spam_check;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'bcc' => $this->getBccSettings(),
                'bypass_list_management' => $this->getBypassListManagement(),
                'footer' => $this->getFooter(),
                'sandbox_mode' => $this->getSandboxMode(),
                'spam_check' => $this->getSpamCheck()
            ]
        );
    }
}