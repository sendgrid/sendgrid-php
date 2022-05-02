<?php
/**
 * This file tests Content.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Content;
use SendGrid\Mail\TypeException;

/**
 * This file tests Content.
 *
 * @package SendGrid\Tests
 */
class ContentTest extends TestCase
{
    public function testConstructor()
    {
        $content = new Content('type', 'value');

        $this->assertInstanceOf(Content::class, $content);
        $this->assertSame('type', $content->getType());
        $this->assertSame('value', $content->getValue());
    }

    public function testSetType()
    {
        $content = new Content();
        $content->setType('type');

        $this->assertSame('type', $content->getType());
    }

    public function testSetTypeOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$type" must be a string/');

        $content = new Content();
        $content->setType(123);
    }

    public function testSetValue()
    {
        $content = new Content();
        $content->setValue('value');

        $this->assertSame('value', $content->getValue());
    }

    public function testSetValueOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$value" must be a string/');

        $content = new Content();
        $content->setValue(123);
    }
}
