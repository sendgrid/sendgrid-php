<?php
/**
 * This helper builds the Ganalytics object for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

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
    )
    {
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
        if (!is_bool($enable)) {
            throw new TypeException('$enable must be of type bool.');
        }
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
        if (!is_string($utm_source)) {
            throw new TypeException('$utm_source must be of type string.');
        }
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
        if (!is_string($utm_medium)) {
            throw new TypeException('$utm_medium must be of type string.');
        }
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
        if (!is_string($utm_term)) {
            throw new TypeException('$utm_term must be of type string');
        }
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
        if (!is_string($utm_content)) {
            throw new TypeException('$utm_content must be of type string.');
        }
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
        if (!is_string($utm_campaign)) {
            throw new TypeException('$utm_campaign must be of type string.');
        }
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
