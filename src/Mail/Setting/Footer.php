<?php

namespace SendGrid\Mail\Setting;

final class Footer implements \JsonSerializable
{
    /**
     * @var bool
     */
    private $enable;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $html;

    /**
     * @param bool $enable
     * @param string $text
     * @param string $html
     */
    public function __construct($enable, $text, $html)
    {
        $this->validateScalars($enable, $text, $html);
        $this->enable = $enable;
        $this->text   = $text;
        $this->html   = $html;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "enable" => $this->enable,
            "text"   => $this->text,
            "html"   => $this->html
        ];
    }

    /**
     * @param bool $enable
     * @param string $text
     * @param string $html
     */
    private function validateScalars($enable, $text, $html)
    {
        if (!is_bool($enable) || !is_string($text) || !is_string($html)) {
            throw new \InvalidArgumentException('Arguments must be boolean and string');
        }
    }
}
