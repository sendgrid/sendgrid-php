<?php
/**
 * This file tests Footer.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Footer;
use SendGrid\Mail\TypeException;

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

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $footer = new Footer();
        $footer->setEnable('invalid_bool');
    }

    public function testSetText()
    {
        $footer = new Footer();
        $footer->setText('footer_text');

        $this->assertSame('footer_text', $footer->getText());
    }

    public function testSetTextOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$text" must be a string/');

        $footer = new Footer();
        $footer->setText(123);
    }

    public function testSetHtml()
    {
        $footer = new Footer();
        $footer->setHtml('footer_html');

        $this->assertSame('footer_html', $footer->getHtml());
    }

    public function testSetHtmlOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$html" must be a string/');

        $footer = new Footer();
        $footer->setHtml(123);
    }
}
