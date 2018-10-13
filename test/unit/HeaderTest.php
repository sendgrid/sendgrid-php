<?php
/**
 * This file tests Header.
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
     * @expectedExceptionMessage $key must be of type string.
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
     * @expectedExceptionMessage $value must be of type string.
     */
    public function testSetValueOnInvalidType()
    {
        $header = new Header();
        $header->setValue(['text/plain']);
    }
}
