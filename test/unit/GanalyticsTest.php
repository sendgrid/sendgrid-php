<?php
/**
 * This file tests Ganalytics.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Ganalytics;
use SendGrid\Mail\TypeException;

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

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $ganalytics = new Ganalytics();
        $ganalytics->setEnable('invalid_bool');
    }

    public function testSetCampaignContent()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignContent('utm_content');

        $this->assertSame('utm_content', $ganalytics->getCampaignContent());
    }

    public function testSetCampaignContentOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$utm_content" must be a string/');

        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignContent(123);
    }

    public function testSetCampaignTerm()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignTerm('utm_term');

        $this->assertSame('utm_term', $ganalytics->getCampaignTerm());
    }

    public function testSetCampaignTermOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$utm_term" must be a string/');

        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignTerm(123);
    }

    public function testSetCampaignMedium()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignMedium('utm_medium');

        $this->assertSame('utm_medium', $ganalytics->getCampaignMedium());
    }

    public function testSetCampaignMediumOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$utm_medium" must be a string/');

        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignMedium(123);
    }

    public function testSetCampaignSource()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignSource('utm_campaign');

        $this->assertSame('utm_campaign', $ganalytics->getCampaignSource());
    }

    public function testSetCampaignSourceOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$utm_source" must be a string/');

        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignSource(123);
    }

    public function testSetCampaignName()
    {
        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignName('utm_campaign_name');

        $this->assertSame('utm_campaign_name', $ganalytics->getCampaignName());
    }

    public function testSetCampaignNameOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$utm_campaign" must be a string/');

        $ganalytics = new Ganalytics();
        $ganalytics->setCampaignName(123);
    }
}
