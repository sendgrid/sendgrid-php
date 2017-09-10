<?php

namespace SendGrid\Mail\Setting;

use SendGrid\Mail\Setting\Exception\BccSettingIsAlreadySetException;
use SendGrid\Mail\Setting\Exception\FooterSettingIsAlreadySetException;
use SendGrid\Mail\Setting\Exception\SpamCheckSettingIsAlreadySetException;
use SendGrid\Mail\Setting\Exception\SandBoxModeSettingIsAlreadySetException;
use SendGrid\Mail\Setting\Exception\ByPassListManagementSettingIsAlreadySetException;

final class MailSettings implements \JsonSerializable
{
    /**
     * @var BccSettings|null
     */
    private $bccSettings;

    /**
     * @var ByPassListManagement|null
     */
    private $byPassListManagement;

    /**
     * @var Footer|null
     */
    private $footer;

    /**
     * @var SandBoxMode|null
     */
    private $sandBoxMode;

    /**
     * @var SpamCheck|null
     */
    private $spamCheck;

    /**
     * @param BccSettings $bccSettings
     * @return MailSettings
     * @throws BccSettingIsAlreadySetException
     */
    public function addBcc(BccSettings $bccSettings)
    {
        if ($this->hasBccSettings()) {
            throw new BccSettingIsAlreadySetException;
        }
        $this->bccSettings = $bccSettings;

        return $this;
    }

    /**
     * @param ByPassListManagement $byPassListManagement
     * @return MailSettings
     * @throws ByPassListManagementSettingIsAlreadySetException
     */
    public function addByPassListManagement(ByPassListManagement $byPassListManagement)
    {
        if ($this->hasBypassListManagement()) {
            throw new ByPassListManagementSettingIsAlreadySetException;
        }
        $this->byPassListManagement = $byPassListManagement;

        return $this;
    }

    /**
     * @param Footer $footer
     * @return MailSettings
     * @throws FooterSettingIsAlreadySetException
     */
    public function addFooter(Footer $footer)
    {
        if ($this->hasFooter()) {
            throw new FooterSettingIsAlreadySetException;
        }
        $this->footer = $footer;

        return $this;
    }

    /**
     * @param SandBoxMode $sandBoxMode
     * @return MailSettings
     * @throws SandBoxModeSettingIsAlreadySetException
     */
    public function addSandBoxMode(SandBoxMode $sandBoxMode)
    {
        if ($this->hasSandBoxMode()) {
            throw new SandBoxModeSettingIsAlreadySetException;
        }
        $this->sandBoxMode = $sandBoxMode;

        return $this;
    }

    /**
     * @param SpamCheck $spamCheck
     * @return MailSettings
     * @throws SpamCheckSettingIsAlreadySetException
     */
    public function addSpamCheck(SpamCheck $spamCheck)
    {
        if ($this->hasSpamCheck()) {
            throw new SpamCheckSettingIsAlreadySetException;
        }
        $this->spamCheck = $spamCheck;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return
            null === $this->bccSettings &&
            null === $this->byPassListManagement &&
            null === $this->footer &&
            null === $this->sandBoxMode &&
            null === $this->spamCheck;
    }

    /**
     * @return bool
     */
    public function hasBccSettings()
    {
        return null !== $this->bccSettings;
    }

    /**
     * @return bool
     */
    public function hasBypassListManagement()
    {
        return null !== $this->byPassListManagement;
    }

    /**
     * @return bool
     */
    public function hasFooter()
    {
        return null !== $this->footer;
    }

    /**
     * @return bool
     */
    public function hasSandBoxMode()
    {
        return null !== $this->sandBoxMode;
    }

    /**
     * @return bool
     */
    public function hasSpamCheck()
    {
        return null !== $this->spamCheck;
    }

    /**
     * @return array|null
     */
    public function jsonSerialize()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return array_filter($this->getProperties(), function ($value) {
            return $value !== null;
        });
    }

    /**
     * @return array
     */
    private function getProperties()
    {
        return [
            'bcc'                    => $this->bccSettings,
            'bypass_list_management' => $this->byPassListManagement,
            'footer'                 => $this->footer,
            'sandbox_mode'           => $this->sandBoxMode,
            'spam_check'             => $this->spamCheck
        ];
    }
}
