<?php namespace SendGrid\Mail;

class OpenTracking implements \JsonSerializable
{
    private $enable;
    private $substitution_tag;

    public function __construct($enable=null, $substitution_tag=null)
    {
        if(isset($enable)) $this->setEnable($enable);
        if(isset($substitution_tag)) $this->setSubstitutionTag($substitution_tag);
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setSubstitutionTag($substitution_tag)
    {
        $this->substitution_tag = $substitution_tag;
    }

    public function getSubstitutionTag()
    {
        return $this->substitution_tag;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'           => $this->getEnable(),
                'substitution_tag' => $this->getSubstitutionTag()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
