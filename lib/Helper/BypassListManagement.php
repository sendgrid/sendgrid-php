<?php

namespace SendGrid\Helper;

/**
 * Class BypassListManagement
 * @package SendGrid\Helper
 */
class BypassListManagement implements \jsonSerializable
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