<?php
/**
 * This file tests ClickTracking.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\ClickTracking;
use SendGrid\Mail\TypeException;

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

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $clickTracking = new ClickTracking();
        $clickTracking->setEnable('invalid_bool');
    }

    public function testSetEnableText()
    {
        $clickTracking = new ClickTracking();
        $clickTracking->setEnableText(true);

        $this->assertTrue($clickTracking->getEnableText());
    }

    public function testSetEnableTextOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable_text" must be a boolean/');

        $clickTracking = new ClickTracking();
        $clickTracking->setEnableText('invalid_bool');
    }
}
