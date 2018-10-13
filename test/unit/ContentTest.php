<?php
/**
 * This file tests Content.
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
     * @expectedExceptionMessage $type must be of type string.
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
     * @expectedExceptionMessage $value must be of type string.
     */
    public function testSetValueOnInvalidType()
    {
        $content = new Content();
        $content->setValue(['value']);
    }
}
