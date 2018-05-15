<?php 
/**
 * This helper builds the TrackingSettings object for a /mail/send API call
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
 * This class is used to construct a TrackingSettings object for the /mail/send API call
 * 
 * @package SendGrid\Mail
 */
class TrackingSettings implements \JsonSerializable
{
    // @var ClickTracking object
    private $click_tracking;
    // @var OpenTracking object
    private $open_tracking;
    // @var SubscriptionTracking object
    private $subscription_tracking;
    // @var Ganalytics object
    private $ganalytics;

    public function __construct(
        $click_tracking=null,
        $open_tracking=null,
        $subscription_tracking=null,
        $ganalytics=null
    ) {
        if(isset($click_tracking)) $this->setClickTracking($click_trackingc);
        if(isset($open_tracking)) $this->setOpenTracking($open_tracking);
        if(isset($subscription_tracking)) $this->setSubscriptionTracking($subscription_tracking);
        if(isset($ganalytics)) $this->setGanalytics($ganalytics);
    }

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

    /**
     * Return an array representing a TrackingSettings object for the SendGrid API
     * 
     * @return null|array
     */  
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
