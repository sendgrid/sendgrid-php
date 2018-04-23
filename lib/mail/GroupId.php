<?php namespace SendGrid\Mail;

class GroupId implements \JsonSerializable
{
    public $group_id;

    public function __construct(int $group_id=null)
    {
        if ($group_id) {
            $this->group_id = $group_id;
        }
        return;
    }

    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setGroupId(int $group_id)
    {
        $this->group_id = $group_id;
    }

    public function jsonSerialize()
    {
        return $this->getGroupId();
    }
}