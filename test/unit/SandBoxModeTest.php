<?php
/**
 * This file tests SandBoxMode.
 */

namespace SendGrid\Tests\Unit;

use SendGrid\Mail\SandBoxMode;
use PHPUnit\Framework\TestCase;

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

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$enable" must be a boolean.
     */
    public function testSetEnableOnInvalidType()
    {
        $sandBoxMode = new SandBoxMode();
        $sandBoxMode->setEnable('invalid_bool');
    }
}
