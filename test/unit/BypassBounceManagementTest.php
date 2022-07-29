<?php
/**
 * This file tests BypassBounceManagement.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BypassBounceManagement;
use SendGrid\Mail\TypeException;

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

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $bypassBounceManagement = new BypassBounceManagement();
        $bypassBounceManagement->setEnable('invalid_bool_type');
    }
}
