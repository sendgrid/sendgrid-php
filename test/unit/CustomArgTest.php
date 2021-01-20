<?php
/**
 * This file tests CustomArg.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\CustomArg;

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

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$key" must be a string.
     */
    public function testSetKeyOnInvalidType()
    {
        $customArg = new CustomArg();
        $customArg->setKey(['key']);
    }

    public function testSetValue()
    {
        $customArg = new CustomArg();
        $customArg->setValue('value');

        $this->assertSame('value', $customArg->getValue());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$value" must be a string.
     */
    public function testSetValueOnInvalidType()
    {
        $customArg = new CustomArg();
        $customArg->setValue(['value']);
    }
}
