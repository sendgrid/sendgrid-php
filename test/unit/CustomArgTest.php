<?php
/**
 * This file tests CustomArg.
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
     * @expectedExceptionMessage $key must be of type string.
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
     * @expectedExceptionMessage $value must be of type string.
     */
    public function testSetValueOnInvalidType()
    {
        $customArg = new CustomArg();
        $customArg->setValue(['value']);
    }
}
