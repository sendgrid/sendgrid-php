<?php
/**
 * This file tests SandBoxMode
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

use SendGrid\Mail\SandBoxMode;
use PHPUnit\Framework\TestCase;

/**
 * This class tests SandBoxMode
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
     * @expectedExceptionMessage $enable must be of type bool.
     */
    public function testSetEnableOnInvalidType()
    {
        $sandBoxMode = new SandBoxMode();
        $sandBoxMode->setEnable('invalid_bool');
    }
}
