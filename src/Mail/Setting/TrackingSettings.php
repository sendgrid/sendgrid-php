<?php

namespace SendGrid\Mail\Setting;

use SendGrid\Mail\Setting\Exception\ClickTrackingIsAlreadySetException;
use SendGrid\Mail\Setting\Exception\OpenTrackingSettingIsAlreadySetException;
use SendGrid\Mail\Setting\Exception\GoogleAnalyticsSettingIsAlreadySetException;
use SendGrid\Mail\Setting\Exception\SubscriptionTrackingSettingIsAlreadySetException;

final class TrackingSettings implements \JsonSerializable
{
    /**
     * @var ClickTracking|null
     */
    private $clickTracking;

    /**
     * @var  OpenTracking|null
     */
    private $openTracking;

    /**
     * @var  SubscriptionTracking|null
     */
    private $subscriptionTracking;

    /**
     * @var  GoogleAnalytics|null
     */
    private $googleAnalytics;

    /**
     * @param ClickTracking $clickTracking
     * @return TrackingSettings
     * @throws ClickTrackingIsAlreadySetException
     */
    public function addClickTracking(ClickTracking $clickTracking)
    {
        if ($this->hasClickTracking()) {
            throw new ClickTrackingIsAlreadySetException;
        }
        $this->clickTracking = $clickTracking;

        return $this;
    }

    /**
     * @param OpenTracking $openTracking
     * @return TrackingSettings
     * @throws OpenTrackingSettingIsAlreadySetException
     */
    public function addOpenTracking(OpenTracking $openTracking)
    {
        if ($this->hasOpenTracking()) {
            throw new OpenTrackingSettingIsAlreadySetException;
        }
        $this->openTracking = $openTracking;

        return $this;
    }

    /**
     * @param SubscriptionTracking $subscriptionTracking
     * @return TrackingSettings
     * @throws SubscriptionTrackingSettingIsAlreadySetException
     */
    public function addSubscriptionTracking(SubscriptionTracking $subscriptionTracking)
    {
        if ($this->hasSubscriptionTracking()) {
            throw new SubscriptionTrackingSettingIsAlreadySetException;
        }
        $this->subscriptionTracking = $subscriptionTracking;

        return $this;
    }

    /**
     * @param GoogleAnalytics $googleAnalytics
     * @return TrackingSettings
     * @throws GoogleAnalyticsSettingIsAlreadySetException
     */
    public function addGoogleAnalytics(GoogleAnalytics $googleAnalytics)
    {
        if ($this->hasGoogleAnalytics()) {
            throw new GoogleAnalyticsSettingIsAlreadySetException;
        }
        $this->googleAnalytics = $googleAnalytics;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return
            null === $this->clickTracking &&
            null === $this->openTracking &&
            null === $this->subscriptionTracking &&
            null === $this->googleAnalytics;
    }

    /**
     * @return bool
     */
    public function hasClickTracking()
    {
        return null !== $this->clickTracking;
    }

    /**
     * @return bool
     */
    public function hasOpenTracking()
    {
        return null !== $this->openTracking;
    }

    /**
     * @return bool
     */
    public function hasSubscriptionTracking()
    {
        return null !== $this->subscriptionTracking;
    }

    /**
     * @return bool
     */
    public function hasGoogleAnalytics()
    {
        return null !== $this->googleAnalytics;
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
            "click_tracking"        => $this->clickTracking,
            "open_tracking"         => $this->openTracking,
            "subscription_tracking" => $this->subscriptionTracking,
            "ganalytics"            => $this->googleAnalytics
        ];
    }
}
