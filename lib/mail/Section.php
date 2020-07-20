<?php
/**
 * This helper builds the Section object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a Section object for the /mail/send API call
 *
 * An object of key/value pairs that define block sections of code to be used
 * as substitutions
 *
 * @package SendGrid\Mail
 */
class Section implements \JsonSerializable
{
    /** @var $key string Section key */
    private $key;
    /** @var $value string Section value */
    private $value;

	/**
	 * Optional constructor
	 *
	 * @param string|null $key   Section key
	 * @param string|null $value Section value
	 * @throws \SendGrid\Mail\TypeException
	 */
    public function __construct($key = null, $value = null)
    {
        if (isset($key)) {
            $this->setKey($key);
        }
        if (isset($value)) {
            $this->setValue($value);
        }
    }

    /**
     * Add the key on a Section object
     *
     * @param string $key Section key
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setKey($key)
    {
        Assert::string($key, 'key');

        $this->key = $key;
    }

    /**
     * Retrieve the key from a Section object
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Add the value on a Section object
     *
     * @param string $value Section value
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setValue($value)
    {
        Assert::string($value, 'value');

        $this->value = $value;
    }

    /**
     * Retrieve the value from a Section object
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return an array representing a Section object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'key' => $this->getKey(),
                'value' => $this->getValue()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
