<?php
/**
 * This file tests SubscriptionTracking
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Tests;

use SendGrid\Mail\SubscriptionTracking;
use PHPUnit\Framework\TestCase;

/**
 * This class tests SubscriptionTracking
 *
 * @package SendGrid\Tests
 */
class SubscriptionTrackingTest extends TestCase
{
    public function testConstructor()
    {
        $subscriptionTracking = new SubscriptionTracking(true, 'text', '<h1>html</h1>', 'sub_tag');

        $this->assertInstanceOf(SubscriptionTracking::class, $subscriptionTracking);
        $this->assertTrue($subscriptionTracking->getEnable());
        $this->assertSame('text', $subscriptionTracking->getText());
        $this->assertSame('<h1>html</h1>', $subscriptionTracking->getHtml());
        $this->assertSame('sub_tag', $subscriptionTracking->getSubstitutionTag());
    }

    public function testSetEnable()
    {
        $subscriptionTracking = new SubscriptionTracking();
        $subscriptionTracking->setEnable(true);

        $this->assertTrue($subscriptionTracking->getEnable());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $enable must be of type bool.
     */
    public function testSetEnableOnInvalidType()
    {
        $subscriptionTracking = new SubscriptionTracking();
        $subscriptionTracking->setEnable('invalid_bool_type');
    }

    public function testSetText()
    {
        $subscriptionTracking = new SubscriptionTracking();
        $subscriptionTracking->setText('text');

        $this->assertSame('text', $subscriptionTracking->getText());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $text must be of type string.
     */
    public function testSetTextOnInvalidType()
    {
        $subscriptionTracking = new SubscriptionTracking();
        $subscriptionTracking->setText(true);
    }

    public function testSetHtml()
    {
        $subscriptionTracking = new SubscriptionTracking();
        $subscriptionTracking->setHtml('<h1>I am html text</h1>');

        $this->assertSame('<h1>I am html text</h1>', $subscriptionTracking->getHtml());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $html must be of type string.
     */
    public function testSetHtmlOnInvalidType()
    {
        $subscriptionTracking = new SubscriptionTracking();
        $subscriptionTracking->setHtml(true);
    }

    public function testSetSubstitutionTag()
    {
        $subscriptionTracking = new SubscriptionTracking();
        $subscriptionTracking->setSubstitutionTag('sub_tag');

        $this->assertSame('sub_tag', $subscriptionTracking->getSubstitutionTag());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $substitution_tag must be of type string.
     */
    public function testSetSubstitutionTagOnInvalidType()
    {
        $subscriptionTracking = new SubscriptionTracking();
        $subscriptionTracking->setSubstitutionTag(true);
    }
}
