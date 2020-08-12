<?php
/**
 * This file tests OpenTracking.
 */

namespace SendGrid\Tests;

use SendGrid\Mail\OpenTracking;
use PHPUnit\Framework\TestCase;

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

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $enable must be of type bool.
     */
    public function testSetEnableOnInvalidType()
    {
        $openTracking = new OpenTracking();
        $openTracking->setEnable('invalid_bool');
    }

    public function testSetSubstitutionTag()
    {
        $openTracking = new OpenTracking();
        $openTracking->setSubstitutionTag('substitution_tag');

        $this->assertSame('substitution_tag', $openTracking->getSubstitutionTag());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $substitution_tag must be of type string.
     */
    public function testSetSubstitutionTagOnInvalidType()
    {
        $openTracking = new OpenTracking();
        $openTracking->setSubstitutionTag(['invalid_substitution_tag']);
    }
}