<?php
/**
 * GroupsToDisplay class unit tests.
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
use SendGrid\Mail\GroupsToDisplay;
use SendGrid\Mail\TypeException;

class GroupsToDisplayTest extends TestCase
{
    public function testSetGroupsToDisplayWithExceededElementsCount()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Number of elements in "$groups_to_display" can not be more than 25.');

        $data = range(1, 30);
        $groups = new GroupsToDisplay();
        $groups->setGroupsToDisplay($data);
    }

    public function testAddGroupToDisplayWithAlready()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Number of elements in "$groups_to_display" can not be more than 25.');

        $data = range(1, 25);
        $groups = new GroupsToDisplay($data);
        $groups->addGroupToDisplay(1);
    }
}