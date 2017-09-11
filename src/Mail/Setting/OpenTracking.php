<?php

namespace SendGrid\Mail\Setting;

final class OpenTracking implements \JsonSerializable
{
    /**
     * @var bool
     */
    private $enable;

    /**
     * @var string
     */
    private $substitutionTag;

    /**
     * @param bool $enable
     * @param string $substitutionTag
     */
    public function __construct($enable, $substitutionTag)
    {
        $this->validateScalar($enable, $substitutionTag);
        $this->enable          = $enable;
        $this->substitutionTag = $substitutionTag;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "enable"           => $this->enable,
            "substitution_tag" => $this->substitutionTag
        ];
    }

    /**
     * @param $enable
     * @param $substitutionTag
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateScalar($enable, $substitutionTag)
    {
        if (!is_bool($enable) || !is_string($substitutionTag)) {
            throw new \InvalidArgumentException;
        }
    }
}
