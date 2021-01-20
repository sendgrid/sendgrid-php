<?php
/**
 * This file tests Footer.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Footer;

/**
 * This file tests Footer.
 *
 * @package SendGrid\Tests
 */
class FooterTest extends TestCase
{
    public function testConstructor()
    {
        $footer = new Footer(true, 'footer_text', '<p>footer_html</p>');

        $this->assertInstanceOf(Footer::class, $footer);
        $this->assertTrue($footer->getEnable());
        $this->assertSame('footer_text', $footer->getText());
        $this->assertSame('<p>footer_html</p>', $footer->getHtml());
    }

    public function testSetEnable()
    {
        $footer = new Footer();
        $footer->setEnable(true);

        $this->assertTrue($footer->getEnable());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$enable" must be a boolean.
     */
    public function testSetEnableOnInvalidType()
    {
        $footer = new Footer();
        $footer->setEnable('invalid_bool');
    }

    public function testSetText()
    {
        $footer = new Footer();
        $footer->setText('footer_text');

        $this->assertSame('footer_text', $footer->getText());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$text" must be a string.
     */
    public function testSetTextOnInvalidType()
    {
        $footer = new Footer();
        $footer->setText(['footer_text']);
    }

    public function testSetHtml()
    {
        $footer = new Footer();
        $footer->setHtml('footer_html');

        $this->assertSame('footer_html', $footer->getHtml());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$html" must be a string.
     */
    public function testSetHtmlOnInvalidType()
    {
        $footer = new Footer();
        $footer->setHtml(['footer_html']);
    }
}
