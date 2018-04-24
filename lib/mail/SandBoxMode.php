<?php namespace SendGrid\Mail;

class SandBoxMode implements \JsonSerializable
{
    private $enable;

    public function __construct($enable)
    {
        $this->setEnable($enable);
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
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
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
