<?php

namespace SendGrid\Helper\Mail;

/**
 * Class ClickTracking
 * @package SendGrid
 */
class ClickTracking implements \JsonSerializable
{
    private $enable;
    private $enable_text;

    /**
     * @param $enable
     * @return $this
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param $enable_text
     * @return $this
     */
    public function setEnableText($enable_text)
    {
        $this->enable_text = $enable_text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnableText()
    {
        return $this->enable_text;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'      => $this->getEnable(),
                'enable_text' => $this->getEnableText()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}