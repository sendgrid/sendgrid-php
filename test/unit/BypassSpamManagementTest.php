<?php
/**
 * This file tests BypassSpamManagement.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BypassSpamManagement;

/**
 * This file tests BypassSpamManagement.
 *
 * @package SendGrid\Tests
 */
class BypassSpamManagementTest extends TestCase
{
    public function testConstructor()
    {
        $bypassSpamManagement = new BypassSpamManagement(true);

        $this->assertInstanceOf(BypassSpamManagement::class, $bypassSpamManagement);
        $this->assertTrue($bypassSpamManagement->getEnable());
    }

    public function testSetEnable()
    {
        $bypassSpamManagement = new BypassSpamManagement();
        $bypassSpamManagement->setEnable(true);

        $this->assertTrue($bypassSpamManagement->getEnable());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$enable" must be a boolean.
     */
    public function testSetEnableOnInvalidType()
    {
        $bypassSpamManagement = new BypassSpamManagement();
        $bypassSpamManagement->setEnable('invalid_bool_type');
    }
}
