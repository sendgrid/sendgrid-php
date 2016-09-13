<?php
/**
  * This helper builds the request body for a /mail/send API call.
  *
  * PHP version 5.3
  *
  * @author    Elmer Thomas <dx@sendgrid.com>
  * @copyright 2016 SendGrid
  * @license   https://opensource.org/licenses/MIT The MIT License
  * @version   GIT: <git_id>
  * @link      http://packagist.org/packages/sendgrid/sendgrid
  */
namespace SendGrid\Helper;

/**
 * Class Ganalytics
 * @package SendGrid\Helper
 */
class Ganalytics implements \jsonSerializable
{
    private $enable;
    private $utm_source;
    private $utm_medium;
    private $utm_term;
    private $utm_content;
    private $utm_campaign;

    /**
     * @param $enable
     * @return $this
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
        return $this;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param $utm_source
     * @return $this
     */
    public function setCampaignSource($utm_source)
    {
        $this->utm_source = $utm_source;
        return $this;
    }

    public function getCampaignSource()
    {
        return $this->utm_source;
    }

    /**
     * @param $utm_medium
     * @return $this
     */
    public function setCampaignMedium($utm_medium)
    {
        $this->utm_medium = $utm_medium;
        return $this;
    }

    public function getCampaignMedium()
    {
        return $this->utm_medium;
    }

    /**
     * @param $utm_term
     * @return $this
     */
    public function setCampaignTerm($utm_term)
    {
        $this->utm_term = $utm_term;
        return $this;
    }

    public function getCampaignTerm()
    {
        return $this->utm_term;
    }

    /**
     * @param $utm_content
     * @return $this
     */
    public function setCampaignContent($utm_content)
    {
        $this->utm_content = $utm_content;
        return $this;
    }

    public function getCampaignContent()
    {
        return $this->utm_content;
    }

    /**
     * @param $utm_campaign
     * @return $this
     */
    public function setCampaignName($utm_campaign)
    {
        $this->utm_campaign = $utm_campaign;
        return $this;
    }

    public function getCampaignName()
    {
        return $this->utm_campaign;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'utm_source' => $this->getCampaignSource(),
                'utm_medium' => $this->getCampaignMedium(),
                'utm_term' => $this->getCampaignTerm(),
                'utm_content' => $this->getCampaignContent(),
                'utm_campaign' => $this->getCampaignName()
            ]
        );
    }
}