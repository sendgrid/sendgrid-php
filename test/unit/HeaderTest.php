<?php
/**
 * This file tests Header.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Header;

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

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$key" must be a string.
     */
    public function testSetKeyOnInvalidType()
    {
        $header = new Header();
        $header->setKey(['Content-Type']);
    }

    public function testSetValue()
    {
        $header = new Header();
        $header->setValue('text/plain');

        $this->assertSame('text/plain', $header->getValue());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$value" must be a string.
     */
    public function testSetValueOnInvalidType()
    {
        $header = new Header();
        $header->setValue(['text/plain']);
    }
}
