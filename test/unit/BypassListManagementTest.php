<?php
/**
 * This file tests BypassListManagement.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BypassListManagement;

/**
 * This file tests BypassListManagement.
 *
 * @package SendGrid\Tests
 */
class BypassListManagementTest extends TestCase
{
    public function testConstructor()
    {
        $bypassListManagement = new BypassListManagement(true);

        $this->assertInstanceOf(BypassListManagement::class, $bypassListManagement);
        $this->assertTrue($bypassListManagement->getEnable());
    }

    public function testSetEnable()
    {
        $bypassListManagement = new BypassListManagement();
        $bypassListManagement->setEnable(true);

        $this->assertTrue($bypassListManagement->getEnable());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$enable" must be a boolean.
     */
    public function testSetEnableOnInvalidType()
    {
        $bypassListManagement = new BypassListManagement();
        $bypassListManagement->setEnable('invalid_bool_type');
    }
}
