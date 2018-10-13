<?php
/**
 * This file tests GroupId.
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
use SendGrid\Mail\GroupId;

/**
 * This file tests GroupId.
 *
 * @package SendGrid\Tests
 */
class GroupIdTest extends TestCase
{
    public function testConstructor()
    {
        $groupId = new GroupId(123456);

        $this->assertSame(123456, $groupId->getGroupId());
    }

    public function testSetGroupId()
    {
        $groupId = new GroupId(123456);
        $groupId->setGroupId(123456);

        $this->assertSame(123456, $groupId->getGroupId());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $group_id must be of type int.
     */
    public function testSetGroupIdOnInvalidType()
    {
        $groupId = new GroupId();
        $groupId->setGroupId('invalid_group_id');
    }

    public function testJsonSerialize()
    {
        $groupId = new GroupId();
        $groupId->setGroupId(123456);

        $this->assertSame(123456, $groupId->jsonSerialize());
    }
}
