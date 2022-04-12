<?php
/**
 * This file tests OpenTracking.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\OpenTracking;
use SendGrid\Mail\TypeException;

/**
 * This class tests OpenTracking.
 *
 * @package SendGrid\Tests
 */
class OpenTrackingTest extends TestCase
{
    public function testConstructor()
    {
        $openTracking = new OpenTracking(true, 'substitution_tag');

        $this->assertTrue($openTracking->getEnable());
        $this->assertSame('substitution_tag', $openTracking->getSubstitutionTag());
    }

    public function testSetEnable()
    {
        $openTracking = new OpenTracking();
        $openTracking->setEnable(true);

        $this->assertTrue($openTracking->getEnable());
    }

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $openTracking = new OpenTracking();
        $openTracking->setEnable('invalid_bool');
    }

    public function testSetSubstitutionTag()
    {
        $openTracking = new OpenTracking();
        $openTracking->setSubstitutionTag('substitution_tag');

        $this->assertSame('substitution_tag', $openTracking->getSubstitutionTag());
    }

    public function testSetSubstitutionTagOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$substitution_tag" must be a string/');

        $openTracking = new OpenTracking();
        $openTracking->setSubstitutionTag(123);
    }
}
