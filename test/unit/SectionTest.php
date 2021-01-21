<?php
/**
 * This file tests Section.
 */

namespace SendGrid\Tests\Unit;

use SendGrid\Mail\Section;
use PHPUnit\Framework\TestCase;

/**
 * This class tests Section.
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
     * @expectedExceptionMessage "$key" must be a string.
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
     * @expectedExceptionMessage "$value" must be a string.
     */
    public function testSetValueOnInvalidType()
    {
        $section = new Section();
        $section->setValue(true);
    }
}
