<?php
/**
 * This file tests OpenTracking
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

use SendGrid\Mail\OpenTracking;
use PHPUnit\Framework\TestCase;

/**
 * This class tests OpenTracking
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
