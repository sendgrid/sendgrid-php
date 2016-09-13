<?php

namespace SendGrid\Helper;

/**
 * Class SubscriptionTracking
 * @package SendGrid\Helper
 */
class SubscriptionTracking implements \jsonSerializable
{
    private
        $enable,
        $text,
        $html,
        $substitution_tag;

    public function setEnable($enable)
    {
        $this->enable = $enable;
        return $this;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function setSubstitutionTag($substitution_tag)
    {
        $this->substitution_tag = $substitution_tag;
        return $this;
    }

    public function getSubstitutionTag()
    {
        return $this->substitution_tag;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'text' => $this->getText(),
                'html' => $this->getHtml(),
                'substitution_tag' => $this->getSubstitutionTag()
            ]
        );
    }
}
