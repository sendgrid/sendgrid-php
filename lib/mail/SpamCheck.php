<?php
/**
 * This helper builds the SpamCheck object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a SpamCheck object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class SpamCheck implements \JsonSerializable
{
    /** @var $enable bool Indicates if this setting is enabled */
    private $enable;

    /**
     * @var $threshold int The threshold used to determine if your content qualifies as
     * spam on a scale from 1 to 10, with 10 being most strict, or most
     * likely to be considered as spam
     */
    private $threshold;

    /**
     * @var $post_to_urlstring An Inbound Parse URL that you would like a copy of your
     * email along with the spam report to be sent to
     */
    private $post_to_url;

    /**
     * Optional constructor
     *
     * @param bool|null   $enable      Indicates if this setting is enabled
     * @param int|null    $threshold   The threshold used to determine if your
     *                                 content qualifies as spam on a scale
     *                                 from 1 to 10, with 10 being most strict,
     *                                 or most
     * @param string|null $post_to_url An Inbound Parse URL that you would like
     *                                 a copy of your email along with the spam
     *                                 report to be sent to
     * @throws \SendGrid\Mail\TypeException
     */
    public function __construct($enable = null, $threshold = null, $post_to_url = null)
    {
        if (isset($enable)) {
            $this->setEnable($enable);
        }
        if (isset($threshold)) {
            $this->setThreshold($threshold);
        }
        if (isset($post_to_url)) {
            $this->setPostToUrl($post_to_url);
        }
    }

    /**
     * Update the enable setting on a SpamCheck object
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
     * Retrieve the enable setting on a SpamCheck object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set the threshold value on a SpamCheck object
     *
     * @param int $threshold The threshold used to determine if your
     *                       content qualifies as spam on a scale
     *                       from 1 to 10, with 10 being most strict,
     *                       or most
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setThreshold($threshold)
    {
        Assert::minValue($threshold, 'threshold', 1);
        Assert::maxValue($threshold, 'threshold', 10);

        $this->threshold = $threshold;
    }

    /**
     * Retrieve the threshold value from a SpamCheck object
     *
     * @return int
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * Set the post to url value on a SpamCheck object
     *
     * @param string $post_to_url An Inbound Parse URL that you would like
     *                            a copy of your email along with the spam
     *                            report to be sent to
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setPostToUrl($post_to_url)
    {
        Assert::string($post_to_url, 'post_to_url');

        $this->post_to_url = $post_to_url;
    }

    /**
     * Retrieve the post to url value from a SpamCheck object
     *
     * @return string
     */
    public function getPostToUrl()
    {
        return $this->post_to_url;
    }

    /**
     * Return an array representing a SpamCheck object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'threshold' => $this->getThreshold(),
                'post_to_url' => $this->getPostToUrl()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
