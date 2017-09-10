<?php

namespace SendGrid\Mail\Setting;

final class SubscriptionTracking implements \JsonSerializable
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
     * @var string
     */
    private $substitutionTag;

    /**
     * @param bool $enable
     * @param string $text
     * @param string $html
     * @param string $substitutionTag
     */
    public function __construct($enable, $text, $html, $substitutionTag)
    {
        $this->validateScalars($enable, $text, $html, $substitutionTag);
        $this->enable          = $enable;
        $this->text            = $text;
        $this->html            = $html;
        $this->substitutionTag = $substitutionTag;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "enable"           => $this->enable,
            "text"             => $this->text,
            "html"             => $this->html,
            "substitution_tag" => $this->substitutionTag
        ];
    }

    /**
     * @param bool $enable
     * @param string $text
     * @param string $html
     * @param string $substitutionTag
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateScalars($enable, $text, $html, $substitutionTag)
    {
        if (!is_bool($enable) || !is_string($text) || !is_string($html) || !is_string($substitutionTag)) {
            throw new \InvalidArgumentException('Arguments must be boolean adn string');
        }
    }
}
