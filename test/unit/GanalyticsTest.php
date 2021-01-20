<?php
/**
 * This file tests Ganalytics.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Ganalytics;

/**
 * This file tests Ganalytics.
 *
 * @package SendGrid\Tests
 */
class GanalyticsTest extends TestCase
{
    public function testConstructor()
    {
        $ganalytics = new Ganalytics(true, 'utm_source', 'utm_medium', 'utm_term', 'utm_content', 'utm_campaign');

        $this->assertInstanceOf(Ganalytics::class, $ganalytics);
        $this->assertTrue($ganalytics->getEnable());
        $this->assertSame('utm_source', $ganalytics->getCampaignSource());
        $this->assertSame('utm_medium', $ganalytics->getCampaignMedium());
        $this->assertSame('utm_term', $ganalytics->getCampaignTerm());
        $this->assertSame('utm_content', $ganalytics->getCampaignContent());
        $this->assertSame('utm_campaign', $ganalytics->getCampaignName());
    }

    public function testSetEnable()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setEnable(true);

        $this->assertTrue($ganalytics->getEnable());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$enable" must be a boolean.
     */
    public function testSetEnableOnInvalidType()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setEnable('invalid_bool');
    }

    public function testSetCampaignContent()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignContent('utm_content');

        $this->assertSame('utm_content', $ganalytics->getCampaignContent());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$utm_content" must be a string.
     */
    public function testSetCampaignContentOnInvalidType()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignContent(['invalid_utm_content']);
    }

    public function testSetCampaignTerm()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignTerm('utm_term');

        $this->assertSame('utm_term', $ganalytics->getCampaignTerm());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$utm_term" must be a string.
     */
    public function testSetCampaignTermOnInvalidType()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignTerm(['invalid_utm_term']);
    }

    public function testSetCampaignMedium()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignMedium('utm_medium');

        $this->assertSame('utm_medium', $ganalytics->getCampaignMedium());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$utm_medium" must be a string.
     */
    public function testSetCampaignMediumOnInvalidType()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignMedium(['invalid_utm_medium']);
    }

    public function testSetCampaignSource()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignSource('utm_campaign');

        $this->assertSame('utm_campaign', $ganalytics->getCampaignSource());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$utm_source" must be a string.
     */
    public function testSetCampaignSourceOnInvalidType()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignSource(['invalid_utm_campaign']);
    }

    public function testSetCampaignName()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignName('utm_campaign_name');

        $this->assertSame('utm_campaign_name', $ganalytics->getCampaignName());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$utm_campaign" must be a string.
     */
    public function testSetCampaignNameOnInvalidType()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignName(['invalid_utm_campaign_name']);
    }
}
