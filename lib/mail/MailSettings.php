<?php namespace SendGrid\Mail;

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
    }

    public function getBccSettings()
    {
        return $this->bcc;
    }

    public function setBypassListManagement($bypass_list_management)
    {
        $this->bypass_list_management = $bypass_list_management;
    }

    public function getBypassListManagement()
    {
        return $this->bypass_list_management;
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function setSandboxMode($sandbox_mode)
    {
        if ($sandbox_mode instanceof SandBoxMode) {
            $this->sandbox_mode = $sandbox_mode->getEnable();
        } else {
            $this->sandbox_mode = $sandbox_mode;
        }
    }

    public function getSandboxMode()
    {
        return $this->sandbox_mode;
    }

    public function enableSandboxMode()
    {
        $this->setSandboxMode(true);
    }

    public function disableSandboxMode()
    {
        $this->setSandboxMode(false);
    }

    public function setSpamCheck($spam_check)
    {
        $this->spam_check = $spam_check;
    }

    public function getSpamCheck()
    {
        return $this->spam_check;
    }

    public function jsonSerialize()
    {
        $sandbox = new SandBoxMode();
        $sandbox->setEnable($this->getSandboxMode());

        return array_filter(
            [
                'bcc'                    => $this->getBccSettings(),
                'bypass_list_management' => $this->getBypassListManagement(),
                'footer'                 => $this->getFooter(),
                'sandbox_mode'           => $sandbox,
                'spam_check'             => $this->getSpamCheck()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
