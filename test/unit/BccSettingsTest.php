<?php
/**
 * This file tests BccSettings.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BccSettings;
use SendGrid\Mail\TypeException;

/**
 * This file tests BccSettings.
 *
 * @package SendGrid\Tests
 */
class BccSettingsTest extends TestCase
{
    public function testConstructor()
    {
        $bccSettings = new BccSettings(true, 'dx@sendgrid.com');

        $this->assertInstanceOf(BccSettings::class, $bccSettings);
        $this->assertTrue($bccSettings->getEnable());
        $this->assertSame('dx@sendgrid.com', $bccSettings->getEmail());
    }

    public function testSetEmail()
    {
        $bccSettings = new BccSettings();
        $bccSettings->setEmail('dx@sendgrid.com');

        $this->assertSame('dx@sendgrid.com', $bccSettings->getEmail());
    }

    public function testSetEmailOnInvalidEmailFormat()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$email" must be a valid email address/');

        $bccSettings = new BccSettings();
        $bccSettings->setEmail('invalid_email_address');
    }

    public function testSetEmailOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$email" must be a string/');

        $bccSettings = new BccSettings();
        $bccSettings->setEmail(123);
    }

    public function testSetEnable()
    {
        $bccSettings = new BccSettings();
        $bccSettings->setEnable(true);

        $this->assertTrue($bccSettings->getEnable());
    }

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $bccSettings = new BccSettings();
        $bccSettings->setEnable('invalid_bool_type');
    }
}
