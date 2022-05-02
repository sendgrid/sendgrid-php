<?php
/**
 * This file tests Header.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Header;
use SendGrid\Mail\TypeException;

/**
 * This file tests Header.
 *
 * @package SendGrid\Tests
 */
class HeaderTest extends TestCase
{
    public function testConstructor()
    {
        $header = new Header('Content-Type', 'text/plain');

        $this->assertSame('Content-Type', $header->getKey());
        $this->assertSame('text/plain', $header->getValue());
    }

    public function testSetKey()
    {
        $header = new Header();
        $header->setKey('Content-Type');

        $this->assertSame('Content-Type', $header->getKey());
    }

    public function testSetKeyOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$key" must be a string/');

        $header = new Header();
        $header->setKey(123);
    }

    public function testSetValue()
    {
        $header = new Header();
        $header->setValue('text/plain');

        $this->assertSame('text/plain', $header->getValue());
    }

    public function testSetValueOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$value" must be a string/');

        $header = new Header();
        $header->setValue(123);
    }
}
