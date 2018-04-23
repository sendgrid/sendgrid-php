<?php namespace SendGrid\Mail;

class GroupsToDisplay implements \JsonSerializable
{
    public $groups_to_display;

    public function __construct(array $groups_to_display=null)
    {
        if ($groups_to_display) {
            $this->groups_to_display = $groups_to_display;
        }
        return;
    }

    public function getGroupsToDisplay()
    {
        return $this->groups_to_display;
    }

    public function addGroupsToDisplay(array $groups_to_display)
    {
        $this->groups_to_display[] = $groups_to_display;
    }

    public function jsonSerialize()
    {
        return $this->getGroupsToDisplay();
    }
}