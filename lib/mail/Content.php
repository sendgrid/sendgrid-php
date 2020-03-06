<?php
/**
 * This helper builds the Content object for a /mail/send API call
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
 * This class is used to construct a Content object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Content implements \JsonSerializable
{
    /** @var $type string The mime type of the content you are including in your email. For example, “text/plain” or “text/html” */
    private $type;
    /** @var $value string The actual content of the specified mime type that you are including in your email */
    private $value;

	/**
	 * Optional constructor
	 *
	 * @param string|null $type  The mime type of the content you are including
	 *                           in your email. For example, “text/plain” or
	 *                           “text/html”
	 * @param string|null $value The actual content of the specified mime type
	 *                           that you are including in your email
	 * @throws \SendGrid\Mail\TypeException
	 */
    public function __construct($type = null, $value = null)
    {
        if (isset($type)) {
            $this->setType($type);
        }
        if (isset($value)) {
            $this->setValue($value);
        }
    }

    /**
     * Add the mime type on a Content object
     *
     * @param string $type The mime type of the content you are including
     *                     in your email. For example, “text/plain” or
     *                     “text/html”
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setType($type)
    {
        if (!is_string($type)) {
            throw new TypeException('$type must be of type string.');
        }
        $this->type = $type;
    }

    /**
     * Retrieve the mime type on a Content object
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add the content value to a Content object
     *
     * @param string $value The actual content of the specified mime type
     *                      that you are including in your email
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setValue($value)
    {
        if (!is_string($value)) {
            throw new TypeException('$value must be of type string');
        }
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    /**
     * Retrieve the content value to a Content object
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return an array representing a Contact object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'type' => $this->getType(),
                'value' => $this->getValue()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
