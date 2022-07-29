<?php
/**
 * This helper builds the Ganalytics object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a Ganalytics object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Ganalytics implements \JsonSerializable
{
    /** @var $enable bool Indicates if this setting is enabled */
    private $enable;
    /** @var $utm_source string Name of the referrer source. (e.g. Google, SomeDomain.com, or Marketing Email) */
    private $utm_source;
    /** @var $utm_medium string Name of the marketing medium. (e.g. Email) */
    private $utm_medium;
    /** @var $utm_term string Used to identify any paid keywords */
    private $utm_term;
    /** @var $utm_content string Used to differentiate your campaign from advertisements */
    private $utm_content;
    /** @var $utm_campaign string The name of the campaign */
    private $utm_campaign;

    /**
     * Optional constructor
     *
     * @param bool|null   $enable       Indicates if this setting is enabled
     * @param string|null $utm_source   Name of the referrer source. (e.g.
     *                                  Google, SomeDomain.com, or Marketing Email)
     * @param string|null $utm_medium   Name of the marketing medium. (e.g. Email)
     * @param string|null $utm_term     Used to identify any paid keywords
     * @param string|null $utm_content  Used to differentiate your campaign from
     *                                  advertisements
     * @param string|null $utm_campaign The name of the campaign
     * @throws \SendGrid\Mail\TypeException
     */
    public function __construct(
        $enable = null,
        $utm_source = null,
        $utm_medium = null,
        $utm_term = null,
        $utm_content = null,
        $utm_campaign = null
    ) {
        if (isset($enable)) {
            $this->setEnable($enable);
        }
        if (isset($utm_source)) {
            $this->setCampaignSource($utm_source);
        }
        if (isset($utm_medium)) {
            $this->setCampaignMedium($utm_medium);
        }
        if (isset($utm_term)) {
            $this->setCampaignTerm($utm_term);
        }
        if (isset($utm_content)) {
            $this->setCampaignContent($utm_content);
        }
        if (isset($utm_campaign)) {
            $this->setCampaignName($utm_campaign);
        }
    }

    /**
     * Update the enable setting on a Ganalytics object
     *
     * @param bool $enable Indicates if this setting is enabled
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setEnable($enable)
    {
        Assert::boolean($enable, 'enable');

        $this->enable = $enable;
    }

    /**
     * Retrieve the enable setting on a Ganalytics object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Add the campaign source to a Ganalytics object
     *
     * @param string $utm_source Name of the referrer source. (e.g.
     *                           Google, SomeDomain.com, or Marketing Email)
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setCampaignSource($utm_source)
    {
        Assert::string($utm_source, 'utm_source');

        $this->utm_source = $utm_source;
    }

    /**
     * Return the campaign source from a Ganalytics object
     *
     * @return string
     */
    public function getCampaignSource()
    {
        return $this->utm_source;
    }

    /**
     * Add the campaign medium to a Ganalytics object
     *
     * @param string $utm_medium Name of the marketing medium. (e.g. Email)
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setCampaignMedium($utm_medium)
    {
        Assert::string($utm_medium, 'utm_medium');

        $this->utm_medium = $utm_medium;
    }

    /**
     * Return the campaign medium from a Ganalytics object
     *
     * @return string
     */
    public function getCampaignMedium()
    {
        return $this->utm_medium;
    }

    /**
     * Add the campaign term to a Ganalytics object
     *
     * @param string $utm_term Used to identify any paid keywords
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setCampaignTerm($utm_term)
    {
        Assert::string($utm_term, 'utm_term');

        $this->utm_term = $utm_term;
    }

    /**
     * Return the campaign term from a Ganalytics object
     *
     * @return string
     */
    public function getCampaignTerm()
    {
        return $this->utm_term;
    }

    /**
     * Add the campaign content to a Ganalytics object
     *
     * @param string $utm_content Used to differentiate your campaign from
     *                            advertisements
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setCampaignContent($utm_content)
    {
        Assert::string($utm_content, 'utm_content');

        $this->utm_content = $utm_content;
    }

    /**
     * Return the campaign content from a Ganalytics object
     *
     * @return string
     */
    public function getCampaignContent()
    {
        return $this->utm_content;
    }

    /**
     * Add the campaign name to a Ganalytics object
     *
     * @param string $utm_campaign The name of the campaign
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setCampaignName($utm_campaign)
    {
        Assert::string($utm_campaign, 'utm_campaign');

        $this->utm_campaign = $utm_campaign;
    }

    /**
     * Return the campaign name from a Ganalytics object
     *
     * @return string
     */
    public function getCampaignName()
    {
        return $this->utm_campaign;
    }

    /**
     * Return an array representing a Ganalytics object for the Twilio SendGrid API
     *
     * @return null|array
     */
    #[\ReturnTypeWillChange]
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
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
