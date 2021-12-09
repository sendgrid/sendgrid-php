<?php
/**
 * This helper builds the CustomArg object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a CustomArg object for the /mail/send API call
 *
 * Values that are specific to the entire send that will be carried along with the
 * email and its activity data. Substitutions will not be made on custom arguments,
 * so any string that is entered into this parameter will be assumed to be the
 * custom argument that you would like to be used. This parameter is overridden by
 * personalizations[x].custom_args if that parameter has been defined. Total custom
 * args size may not exceed 10,000 bytes.
 *
 * @package SendGrid\Mail
 */
class CustomArg implements \JsonSerializable
{
    /** @var $key string Custom arg key */
    private $key;
    /** @var $value string Custom arg value */
    private $value;

    /**
     * Optional constructor
     *
     * @param string|null $key   Custom arg key
     * @param string|null $value Custom arg value
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
     * Add a custom arg key on a CustomArg object
     *
     * @param string $key Custom arg key
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setKey($key)
    {
        Assert::string($key, 'key');

        $this->key = $key;
    }

    /**
     * Retrieve a custom arg key on a CustomArg object
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Add a custom arg value on a CustomArg object
     *
     * @param string $value Custom arg value
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setValue($value)
    {
        Assert::string($value, 'value');

        $this->value = $value;
    }

    /**
     * Retrieve a custom arg key on a CustomArg object
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return an array representing a CustomArg object for the Twilio SendGrid API
     *
     * @return null|array
     */
    #[\ReturnTypeWillChange]
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
