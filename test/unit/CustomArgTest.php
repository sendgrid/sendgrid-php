<?php
/**
 * This file tests CustomArg.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\CustomArg;
use SendGrid\Mail\TypeException;

/**
 * This file tests CustomArg.
 *
 * @package SendGrid\Tests
 */
class CustomArgTest extends TestCase
{
    public function testConstructor()
    {
        $customArg = new CustomArg('key', 'value');

        $this->assertInstanceOf(CustomArg::class, $customArg);
        $this->assertSame('key', $customArg->getKey());
        $this->assertSame('value', $customArg->getValue());
    }

    public function testSetKey()
    {
        $customArg = new CustomArg();
        $customArg->setKey('key');

        $this->assertSame('key', $customArg->getKey());
    }

    public function testSetKeyOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$key" must be a string/');

        $customArg = new CustomArg();
        $customArg->setKey(123);
    }

    public function testSetValue()
    {
        $customArg = new CustomArg();
        $customArg->setValue('value');

        $this->assertSame('value', $customArg->getValue());
    }

    public function testSetValueOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$value" must be a string/');

        $customArg = new CustomArg();
        $customArg->setValue(123);
    }
}
