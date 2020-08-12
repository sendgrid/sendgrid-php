<?php
/**
 * GroupsToDisplay class unit tests.
 */

namespace SendGrid\Tests\Unit;

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

    public function testConstructor()
    {
        $groupsToDisplay = new GroupsToDisplay([123456]);

        $this->assertInstanceOf(GroupsToDisplay::class, $groupsToDisplay);
        $this->assertSame([123456], $groupsToDisplay->getGroupsToDisplay());
    }

    public function testSetGroupsToDisplay()
    {
        $groupsToDisplay = new GroupsToDisplay();
        $groupsToDisplay->setGroupsToDisplay([123456]);

        $this->assertSame([123456], $groupsToDisplay->getGroupsToDisplay());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$groups_to_display" must be an array.
     */
    public function testSetGroupsToDisplayOnInvalidType()
    {
        $groupsToDisplay = new GroupsToDisplay();
        $groupsToDisplay->setGroupsToDisplay('invalid_groups_to_display');
    }

    public function testJsonSerialize()
    {
        $groupsToDisplay = new GroupsToDisplay();
        $groupsToDisplay->setGroupsToDisplay([123456]);

        $this->assertSame([123456], $groupsToDisplay->jsonSerialize());
    }
}
