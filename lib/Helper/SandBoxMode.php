<?php

namespace SendGrid\Helper;

/**
 * Class SandBoxMode
 * @package SendGrid\Helper
 */
class SandBoxMode implements \jsonSerializable
{
    private $enable;

    public function setEnable($enable)
    {
        $this->enable = $enable;
        return $this;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable()
            ]
        );
    }
}