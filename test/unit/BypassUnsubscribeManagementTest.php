<?php
/**
 * This file tests BypassUnsubscribeManagement.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BypassUnsubscribeManagement;
use SendGrid\Mail\TypeException;

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

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $bypassUnsubscribeManagement = new BypassUnsubscribeManagement();
        $bypassUnsubscribeManagement->setEnable('invalid_bool_type');
    }
}
