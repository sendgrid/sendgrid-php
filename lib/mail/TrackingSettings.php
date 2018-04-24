<?php namespace SendGrid\Mail;

class TrackingSettings implements \JsonSerializable
{
    private $click_tracking;
    private $open_tracking;
    private $subscription_tracking;
    private $ganalytics;

    public function setClickTracking($enable, $enable_text=null)
    {
        if ($enable instanceof ClickTracking) {
            $click_tracking = $enable;
            $this->click_tracking = $click_tracking;
            return;
        }
        $this->click_tracking = new ClickTracking($enable, $enable_text);
        return;        
    }

    public function getClickTracking()
    {
        return $this->click_tracking;
    }

    public function setOpenTracking($enable, $substitution_tag=null)
    {
        if ($enable instanceof OpenTracking) {
            $open_tracking = $enable;
            $this->open_tracking = $open_tracking;
            return;
        }
        $this->open_tracking = new OpenTracking($enable, $substitution_tag);
        return;
    }

    public function getOpenTracking()
    {
        return $this->open_tracking;
    }

    public function setSubscriptionTracking($enable, $text=null, $html=null, $substitution_tag=null)
    {
        if ($enable instanceof SubscriptionTracking) {
            $subscription_tracking = $enable;
            $this->subscription_tracking = $subscription_tracking;
            return;
        }
        $this->subscription_tracking = new SubscriptionTracking($enable, $text, $html, $substitution_tag);
    }

    public function getSubscriptionTracking()
    {
        return $this->subscription_tracking;
    }

    public function setGanalytics($enable, $utm_source=null, $utm_medium=null, $utm_term=null, $utm_content=null, $utm_campaign=null)
    {
        if ($enable instanceof Ganalytics) {
            $ganalytics = $enable;
            $this->ganalytics = $ganalytics;
            return;
        }
        $this->ganalytics = new Ganalytics($enable, $utm_source, $utm_medium, $utm_term, $utm_content, $utm_campaign);
    }

    public function getGanalytics()
    {
        return $this->ganalytics;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'click_tracking'        => $this->getClickTracking(),
                'open_tracking'         => $this->getOpenTracking(),
                'subscription_tracking' => $this->getSubscriptionTracking(),
                'ganalytics'            => $this->getGanalytics()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
