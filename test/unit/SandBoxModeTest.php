<?php
/**
 * This file tests SandBoxMode.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\SandBoxMode;
use SendGrid\Mail\TypeException;

/**
 * This class tests SandBoxMode.
 *
 * @package SendGrid\Tests
 */
class SandBoxModeTest extends TestCase
{
    public function testConstructor()
    {
        $sandBoxMode = new SandBoxMode(true);

        $this->assertInstanceOf(SandBoxMode::class, $sandBoxMode);
        $this->assertTrue($sandBoxMode->getEnable());
    }

    public function testSetEnable()
    {
        $sandBoxMode = new SandBoxMode();
        $sandBoxMode->setEnable(true);

        $this->assertTrue($sandBoxMode->getEnable());
    }

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $sandBoxMode = new SandBoxMode();
        $sandBoxMode->setEnable('invalid_bool');
    }
}
