<?php

namespace SendGrid\Mail\Setting;

final class SpamCheck implements \JsonSerializable
{
    /**
     * @var bool
     */
    private $enable;

    /**
     * @var int
     */
    private $threshold;

    /**
     * @var string
     */
    private $postToUrl;

    /**
     * @param bool $enable
     * @param int $threshold
     * @param string $postToUrl
     */
    public function __construct($enable, $threshold, $postToUrl)
    {
        $this->validateScalars($enable, $threshold, $postToUrl);
        $this->enable    = $enable;
        $this->threshold = $threshold;
        $this->postToUrl = $postToUrl;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "enable"      => $this->enable,
            "threshold"   => $this->threshold,
            "post_to_url" => $this->postToUrl
        ];
    }

    /**
     * @param bool $enable
     * @param string $threshold
     * @param string $postToUrl
     */
    private function validateScalars($enable, $threshold, $postToUrl)
    {
        if (!is_bool($enable) || !is_int($threshold) || !is_string($postToUrl)) {
            throw new \InvalidArgumentException;
        }
    }
}
