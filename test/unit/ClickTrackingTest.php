<?php
/**
 * This file tests ClickTracking.
 */
namespace SendGrid\Tests\Unit;

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
     * @expectedExceptionMessage "$enable" must be a boolean.
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
     * @expectedExceptionMessage "$enable_text" must be a boolean.
     */
    public function testSetEnableTextOnInvalidType()
    {
        $clickTracking = new ClickTracking();
        $clickTracking->setEnableText('invalid_bool');
    }
}
