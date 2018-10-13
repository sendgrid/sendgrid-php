<?php
/**
 * This file tests Section
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

use SendGrid\Mail\Section;
use PHPUnit\Framework\TestCase;

/**
 * This class tests Section
 *
 * @package SendGrid\Tests
 */
class SectionTest extends TestCase
{
    public function testConstructor()
    {
        $section = new Section('key', 'value');

        $this->assertInstanceOf(Section::class, $section);
        $this->assertSame('key', $section->getKey());
        $this->assertSame('value', $section->getValue());
    }

    public function testSetKey()
    {
        $section = new Section();
        $section->setKey('key');

        $this->assertSame('key', $section->getKey());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $key must be of type string.
     */
    public function testSetKeyOnInvalidType()
    {
        $section = new Section();
        $section->setKey(true);
    }

    public function testSetValue()
    {
        $section = new Section();
        $section->setValue('value');

        $this->assertSame('value', $section->getValue());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $value must be of type string.
     */
    public function testSetValueOnInvalidType()
    {
        $section = new Section();
        $section->setValue(true);
    }
}
