<?php namespace SendGrid\Mail;

class GroupsToDisplay implements \JsonSerializable
{
    private $groups_to_display;

    public function __construct($groups_to_display=null)
    {
        if(isset($groups_to_display)) $this->setGroupsToDisplay($groups_to_display);
    }

    public function getGroupsToDisplay()
    {
        return $this->groups_to_display;
    }

    public function setGroupsToDisplay($groups_to_display)
    {
        $this->groups_to_display[] = $groups_to_display;
    }

    public function jsonSerialize()
    {
        return $this->getGroupsToDisplay();
    }
}