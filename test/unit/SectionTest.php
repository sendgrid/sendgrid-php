<?php
/**
 * This file tests Section.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Section;
use SendGrid\Mail\TypeException;

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

    public function testSetKeyOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$key" must be a string/');

        $section = new Section();
        $section->setKey(true);
    }

    public function testSetValue()
    {
        $section = new Section();
        $section->setValue('value');

        $this->assertSame('value', $section->getValue());
    }

    public function testSetValueOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$value" must be a string/');

        $section = new Section();
        $section->setValue(true);
    }
}
