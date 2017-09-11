<?php

namespace SendGrid\Mail\Setting;

final class ClickTracking implements \JsonSerializable
{
    /**
     * @var bool
     */
    private $enable;

    /**
     * @var bool
     */
    private $enableText;

    /**
     * @param bool $enable
     * @param bool $enableText
     */
    public function __construct($enable, $enableText)
    {
        $this->validateScalar($enable, $enableText);
        $this->enable     = $enable;
        $this->enableText = $enableText;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'enable'      => $this->enable,
            'enable_text' => $this->enableText
        ];
    }

    /**
     * @param bool $enable
     * @param bool $enableText
     * @throws \InvalidArgumentException
     */
    private function validateScalar($enable, $enableText)
    {
        if (!is_bool($enable) || !is_bool($enableText)) {
            throw new \InvalidArgumentException('Arguments must be boolean and string');
        }
    }
}
