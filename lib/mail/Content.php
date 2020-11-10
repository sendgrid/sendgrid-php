<?php
/**
 * This helper builds the Content object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a Content object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Content implements \JsonSerializable
{
    /**
     * @var string
     * The mime type of the content you are including in your email. For example, “text/plain” or “text/html”
     */
    private $type;

    /**
     * @var string
     * The actual content of the specified mime type that you are including in your email
     */
    private $value;

    /**
     * Optional constructor
     *
     * @param string|null $type  The mime type of the content you are including
     *                           in your email. For example, “text/plain” or
     *                           “text/html”
     * @param string|null $value The actual content of the specified mime type
     *                           that you are including in your email
     *
     * @throws TypeException
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
     * @throws TypeException
     */
    public function setType($type)
    {
        Assert::string($type, 'type');

        $this->type = $type;
    }

    /**
     * Retrieve the mime type on a Content object
     *
     * @return string|null
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
     * @throws TypeException
     */
    public function setValue($value)
    {
        Assert::minLength($value, 'value', 1);

        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    /**
     * Retrieve the content value to a Content object
     *
     * @return string|null
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
