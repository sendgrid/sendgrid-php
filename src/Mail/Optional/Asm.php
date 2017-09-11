<?php

namespace SendGrid\Mail\Optional;

final class Asm implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $groups;

    /**
     * @param int $id
     * @param array $groups
     */
    public function __construct($id, array $groups)
    {
        $this->validateScalar($id);
        $this->id     = $id;
        $this->groups = $groups;
    }

    /**
     * @param $id
     */
    private function validateScalar($id)
    {
        if (!is_int($id)) {
            throw new \InvalidArgumentException('Argument must be integer');
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'group_id'          => $this->id,
            'groups_to_display' => $this->groups
        ];
    }
}
