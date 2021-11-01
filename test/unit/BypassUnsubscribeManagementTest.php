<?php
/**
 * This file tests BypassUnsubscribeManagement.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BypassUnsubscribeManagement;

/**
 * This file tests BypassUnsubscribeManagement.
 *
 * @package SendGrid\Tests
 */
class BypassUnsubscribeManagementTest extends TestCase
{
    public function testConstructor()
    {
        $bypassUnsubscribeManagement = new BypassUnsubscribeManagement(true);

        $this->assertInstanceOf(BypassUnsubscribeManagement::class, $bypassUnsubscribeManagement);
        $this->assertTrue($bypassUnsubscribeManagement->getEnable());
    }

    public function testSetEnable()
    {
        $bypassUnsubscribeManagement = new BypassUnsubscribeManagement();
        $bypassUnsubscribeManagement->setEnable(true);

        $this->assertTrue($bypassUnsubscribeManagement->getEnable());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$enable" must be a boolean.
     */
    public function testSetEnableOnInvalidType()
    {
        $bypassUnsubscribeManagement = new BypassUnsubscribeManagement();
        $bypassUnsubscribeManagement->setEnable('invalid_bool_type');
    }
}
