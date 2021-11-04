<?php
/**
 * This file tests BypassBounceManagement.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BypassBounceManagement;

/**
 * This file tests BypassBounceManagement.
 *
 * @package SendGrid\Tests
 */
class BypassBounceManagementTest extends TestCase
{
    public function testConstructor()
    {
        $bypassBounceManagement = new BypassBounceManagement(true);

        $this->assertInstanceOf(BypassBounceManagement::class, $bypassBounceManagement);
        $this->assertTrue($bypassBounceManagement->getEnable());
    }

    public function testSetEnable()
    {
        $bypassBounceManagement = new BypassBounceManagement();
        $bypassBounceManagement->setEnable(true);

        $this->assertTrue($bypassBounceManagement->getEnable());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$enable" must be a boolean.
     */
    public function testSetEnableOnInvalidType()
    {
        $bypassBounceManagement = new BypassBounceManagement();
        $bypassBounceManagement->setEnable('invalid_bool_type');
    }
}
