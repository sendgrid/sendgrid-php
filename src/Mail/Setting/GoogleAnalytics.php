<?php

namespace SendGrid\Mail\Setting;

final class GoogleAnalytics implements \JsonSerializable
{
    /**
     * @var bool
     */
    private $enable;

    /**
     * @var string
     */
    private $utmSource;

    /**
     * @var string
     */
    private $utmMedium;

    /**
     * @var string
     */
    private $utmTerm;

    /**
     * @var string
     */
    private $utmContent;

    /**
     * @var string
     */
    private $utmCampaign;

    /**
     * @param bool $enable
     * @param string $utmSource
     * @param string $utmMedium
     * @param string $utmTerm
     * @param string $utmContent
     * @param string $utmCampaign
     */
    public function __construct($enable, $utmSource, $utmMedium, $utmTerm, $utmContent, $utmCampaign)
    {
        $this->validateScalar($enable, $utmSource, $utmMedium, $utmTerm, $utmContent, $utmCampaign);
        $this->enable      = $enable;
        $this->utmSource   = $utmSource;
        $this->utmMedium   = $utmMedium;
        $this->utmTerm     = $utmTerm;
        $this->utmContent  = $utmContent;
        $this->utmCampaign = $utmCampaign;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "enable"       => $this->enable,
            "utm_source"   => $this->utmSource,
            "utm_medium"   => $this->utmMedium,
            "utm_term"     => $this->utmTerm,
            "utm_content"  => $this->utmContent,
            "utm_campaign" => $this->utmContent
        ];
    }

    /**
     * @param bool $enable
     * @param string $utmSource
     * @param string $utmMedium
     * @param string $utmTerm
     * @param string $utmContent
     * @param string $utmCampaign
     * @throws \InvalidArgumentException
     */
    private function validateScalar($enable, $utmSource, $utmMedium, $utmTerm, $utmContent, $utmCampaign)
    {
        if (!is_bool($enable)||
            !is_string($utmSource)||
            !is_string($utmMedium) ||
            !is_string($utmTerm) ||
            !is_string($utmContent) ||
            !is_string($utmCampaign)
        ) {
            throw new \InvalidArgumentException('Arguments must be  boolean and string');
        }
    }
}
