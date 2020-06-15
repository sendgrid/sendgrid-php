<?php
/**
 * This helper builds the Substitution object for a /mail/send API call
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a Substitution object for the /mail/send API call
 *
 * A collection of key/value pairs following the pattern "substitution_tag":"value
 * to substitute". All are assumed to be strings. These substitutions will apply
 * to the text and html content of the body of your email, in addition to the
 * subject and reply-to parameters. The total collective size of your substitutions
 * may not exceed 10,000 bytes per personalization object
 *
 * @package SendGrid\Mail
 */
class Substitution implements \JsonSerializable
{
    /** @var $key string Substitution key */
    private $key;
    /** @var $value string Substitution value */
    private $value;

	/**
	 * Optional constructor
	 *
	 * @param string|null $key   Substitution key
	 * @param string|null $value Substitution value
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
     * Add the key on a Substitution object
     *
     * @param string $key Substitution key
     *
     * @throws \SendGrid\Mail\TypeException
     * @return null
     */
    public function setKey($key)
    {
        if (!is_string($key)) {
            throw new TypeException("The key '$key' must be of type string.");
        }
        $this->key = (string) $key;
    }

    /**
     * Retrieve the key from a Substitution object
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Add the value on a Substitution object
     *
     * @param string|array|object|bool|int|float $value Substitution value
     *
     * @throws \SendGrid\Mail\TypeException
     * @return null
     */
    public function setValue($value)
    {
        if (!is_string($value) && !is_array($value) && !is_object($value) && !is_bool($value) && !is_numeric($value)) {
            throw new TypeException("The value '$value' must be of type string, array, object, bool, int, or float.");
        }
        $this->value = $value;
    }

    /**
     * Retrieve the value from a Substitution object
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return an array representing a Substitution object for the Twilio SendGrid API
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
