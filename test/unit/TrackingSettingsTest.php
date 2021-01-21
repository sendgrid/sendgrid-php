<?php
/**
 * This file tests TrackingSettings.
 */

namespace SendGrid\Tests\Unit;

use SendGrid\Mail\TrackingSettings;
use SendGrid\Mail\ClickTracking;
use SendGrid\Mail\OpenTracking;
use SendGrid\Mail\SubscriptionTracking;
use SendGrid\Mail\Ganalytics;
use PHPUnit\Framework\TestCase;

/**
 * This class tests TrackingSettings.
 *
 * @package SendGrid\Tests
 */
class TrackingSettingsTest extends TestCase
{
    public function testConstructor()
    {
        $trackingSettings = new TrackingSettings(
            new ClickTracking(true, true),
            new OpenTracking(true, 'sub_tag'),
            new SubscriptionTracking(true, 'text', '<p>html_text</p>', 'sub_tag'),
            new Ganalytics(true)
        );

        $this->assertTrue($trackingSettings->getClickTracking()->getEnableText());
        $this->assertTrue($trackingSettings->getOpenTracking()->getEnable());
        $this->assertTrue($trackingSettings->getSubscriptionTracking()->getEnable());
        $this->assertTrue($trackingSettings->getGanalytics()->getEnable());
    }

    public function testSetClickTracking()
    {
        $trackingSettings = new TrackingSettings();
        $trackingSettings->setClickTracking(true, true);

        $this->assertTrue($trackingSettings->getClickTracking()->getEnable());
    }

    public function testSetClickTrackingOnInstance()
    {
        $trackingSettings = new TrackingSettings();
        $trackingSettings->setClickTracking(new ClickTracking(true, true));

        $this->assertTrue($trackingSettings->getClickTracking()->getEnable());
    }

    public function testSetOpenTracking()
    {
        $trackingSettings = new TrackingSettings();
        $trackingSettings->setOpenTracking(true);

        $this->assertTrue($trackingSettings->getOpenTracking()->getEnable());
    }

    public function testSetOpenTrackingOnOpenTrackingInstance()
    {
        $trackingSettings = new TrackingSettings();
        $trackingSettings->setOpenTracking(new OpenTracking(true));

        $this->assertTrue($trackingSettings->getOpenTracking()->getEnable());
    }

    public function testSetSubscriptionTracking()
    {
        $trackingSettings = new TrackingSettings();
        $trackingSettings->setSubscriptionTracking(true);

        $this->assertTrue($trackingSettings->getSubscriptionTracking()->getEnable());
    }

    public function testSetSubscriptionTrackingOnSubscriptionTrackingInstance()
    {
        $trackingSettings = new TrackingSettings();
        $trackingSettings->setSubscriptionTracking(new SubscriptionTracking(true));

        $this->assertTrue($trackingSettings->getSubscriptionTracking()->getEnable());
    }

    public function testSetGanalytics()
    {
        $trackingSettings = new TrackingSettings();
        $trackingSettings->setGanalytics(true);

        $this->assertTrue($trackingSettings->getGanalytics()->getEnable());
    }

    public function testSetGanalyticsOnGanalyticsInstance()
    {
        $trackingSettings = new TrackingSettings();
        $trackingSettings->setGanalytics(new Ganalytics(true));

        $this->assertTrue($trackingSettings->getGanalytics()->getEnable());
    }
}
