<?php namespace SendGrid\Mail;

class Asm implements \JsonSerializable
{
    private $group_id;
    private $groups_to_display;

    public function __construct(
        $group_id=null,
        $groups_to_display=null
    ) {
        if(isset($group_id)) $this->setGroupId($group_id);
        if(isset($groups_to_display)) $this->setGroupsToDisplay($groups_to_display);
    }

    public function setGroupId($group_id)
    {
        if ($group_id instanceof GroupId) {
            $this->group_id = $group_id->getGroupId();
        } else {
            $this->group_id = new GroupId($group_id);
        }
        return;
    }

    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setGroupsToDisplay($groups_to_display)
    {
        if ($groups_to_display instanceof GroupsToDisplay) {
            $this->groups_to_display = $groups_to_display->getGroupsToDisplay();
        } else {
            $this->groups_to_display = new GroupsToDisplay($groups_to_display);
        }
        return;
    }

    public function getGroupsToDisplay()
    {
        return $this->groups_to_display;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'group_id'          => $this->getGroupId(),
                'groups_to_display' => $this->getGroupsToDisplay()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
