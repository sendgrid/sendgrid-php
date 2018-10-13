<?php
/**
 * This file tests ClickTracking.
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

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\ClickTracking;

/**
 * This file tests ClickTracking.
 *
 * @package SendGrid\Tests
 */
class ClickTrackingTest extends TestCase
{
    public function testConstructor()
    {
        $clickTracking = new ClickTracking(true, true);

        $this->assertInstanceOf(ClickTracking::class, $clickTracking);
        $this->assertTrue($clickTracking->getEnable());
        $this->assertTrue($clickTracking->getEnableText());
    }

    public function testSetEnable()
    {
        $clickTracking = new ClickTracking();
        $clickTracking->setEnable(true);

        $this->assertTrue($clickTracking->getEnable());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $enable must be of type bool.
     */
    public function testSetEnableOnInvalidType()
    {
        $clickTracking = new ClickTracking();
        $clickTracking->setEnable('invalid_bool');
    }

    public function testSetEnableText()
    {
        $clickTracking = new ClickTracking();
        $clickTracking->setEnableText(true);

        $this->assertTrue($clickTracking->getEnableText());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $enable_text must be of type bool.
     */
    public function testSetEnableTextOnInvalidType()
    {
        $clickTracking = new ClickTracking();
        $clickTracking->setEnableText('invalid_bool');
    }
}
