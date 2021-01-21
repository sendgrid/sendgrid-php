<?php
/**
 * This file tests Content.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Content;

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

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$type" must be a string.
     */
    public function testSetTypeOnInvalidType()
    {
        $content = new Content();
        $content->setType(['type']);
    }

    public function testSetValue()
    {
        $content = new Content();
        $content->setValue('value');

        $this->assertSame('value', $content->getValue());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$value" must be a string.
     */
    public function testSetValueOnInvalidType()
    {
        $content = new Content();
        $content->setValue(['value']);
    }
}
