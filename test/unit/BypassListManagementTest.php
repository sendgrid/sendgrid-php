<?php
/**
 * This file tests BypassListManagement.
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
     * @expectedExceptionMessage $enable must be of type bool.
     */
    public function testSetEnableOnInvalidType()
    {
        $bypassListManagement = new BypassListManagement();
        $bypassListManagement->setEnable('invalid_bool_type');
    }
}
