<?php
/**
 * This helper builds the request body for a /mail/send API call.
 *
 * PHP version 5.6, 7
 *
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2017 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace Helpers;

class Ganalytics implements \JsonSerializable
{
    private $enable;
    private $utm_source;
    private $utm_medium;
    private $utm_term;
    private $utm_content;
    private $utm_campaign;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setCampaignSource($utm_source)
    {
        $this->utm_source = $utm_source;
    }

    public function getCampaignSource()
    {
        return $this->utm_source;
    }

    public function setCampaignMedium($utm_medium)
    {
        $this->utm_medium = $utm_medium;
    }

    public function getCampaignMedium()
    {
        return $this->utm_medium;
    }

    public function setCampaignTerm($utm_term)
    {
        $this->utm_term = $utm_term;
    }

    public function getCampaignTerm()
    {
        return $this->utm_term;
    }

    public function setCampaignContent($utm_content)
    {
        $this->utm_content = $utm_content;
    }

    public function getCampaignContent()
    {
        return $this->utm_content;
    }

    public function setCampaignName($utm_campaign)
    {
        $this->utm_campaign = $utm_campaign;
    }

    public function getCampaignName()
    {
        return $this->utm_campaign;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'       => $this->getEnable(),
                'utm_source'   => $this->getCampaignSource(),
                'utm_medium'   => $this->getCampaignMedium(),
                'utm_term'     => $this->getCampaignTerm(),
                'utm_content'  => $this->getCampaignContent(),
                'utm_campaign' => $this->getCampaignName()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
