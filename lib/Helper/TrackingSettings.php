<?php

namespace SendGrid\Helper;

/**
 * Class TrackingSettings
 * @package SendGrid\Helper
 */
class TrackingSettings implements \JsonSerializable
{
    private $click_tracking;
    private $open_tracking;
    private $subscription_tracking;
    private $ganalytics;

    public function setClickTracking($click_tracking)
    {
        $this->click_tracking = $click_tracking;
        return $this;
    }

    public function getClickTracking()
    {
        return $this->click_tracking;
    }

    public function setOpenTracking($open_tracking)
    {
        $this->open_tracking = $open_tracking;
        return $this;
    }

    public function getOpenTracking()
    {
        return $this->open_tracking;
    }

    public function setSubscriptionTracking($subscription_tracking)
    {
        $this->subscription_tracking = $subscription_tracking;
        return $this;
    }

    public function getSubscriptionTracking()
    {
        return $this->subscription_tracking;
    }

    public function setGanalytics($ganalytics)
    {
        $this->ganalytics = $ganalytics;
        return $this;
    }

    public function getGanalytics()
    {
        return $this->ganalytics;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'click_tracking' => $this->getClickTracking(),
                'open_tracking' => $this->getOpenTracking(),
                'subscription_tracking' => $this->getSubscriptionTracking(),
                'ganalytics' => $this->getGanalytics()
            ]
        );
    }
}
