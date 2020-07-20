<?php
/**
 * This helper builds the Footer object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a Footer object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Footer implements \JsonSerializable
{
    /** @var $enable bool Indicates if this setting is enabled */
    private $enable;
    /** @var $text string The plain text content of your footer */
    private $text;
    /** @var $html string The HTML content of your footer */
    private $html;

	/**
	 * Optional constructor
	 *
	 * @param bool|null   $enable Indicates if this setting is enabled
	 * @param string|null $text   The plain text content of your footer
	 * @param string|null $html   The HTML content of your footer
	 * @throws \SendGrid\Mail\TypeException
	 */
    public function __construct($enable = null, $text = null, $html = null)
    {
        if (isset($enable)) {
            $this->setEnable($enable);
        }
        if (isset($text)) {
            $this->setText($text);
        }
        if (isset($html)) {
            $this->setHtml($html);
        }
    }

    /**
     * Update the enable setting on a Footer object
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
     * Retrieve the enable setting on a Footer object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Add text to a Footer object
     *
     * @param string $text The plain text content of your footer
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setText($text)
    {
        Assert::string($text, 'text');

        $this->text = $text;
    }

    /**
     * Retrieve text to a Footer object
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Add html to a Footer object
     *
     * @param string $html The HTML content of your footer
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setHtml($html)
    {
        Assert::string($html, 'html');

        $this->html = $html;
    }

    /**
     * Retrieve html from a Footer object
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Return an array representing a Footer object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'text' => $this->getText(),
                'html' => $this->getHtml()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
