<?php

namespace SendGrid\Helper\Mail;

/**
 * Class ASM
 * @package SendGrid\Helper
 */
class ASM implements \JsonSerializable
{
    private $group_id;
    private $groups_to_display;

    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
        return $this;
    }

    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setGroupsToDisplay($group_ids)
    {
        $this->groups_to_display = $group_ids;
        return $this;
    }

    public function getGroupsToDisplay()
    {
        return $this->groups_to_display;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'group_id' => $this->getGroupId(),
                'groups_to_display' => $this->getGroupsToDisplay()
            ]
        );
    }
}
