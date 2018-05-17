<?php 
/**
 * This helper builds the Section object for a /mail/send API call
 * 
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid 
 */
namespace SendGrid\Mail;

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
    // @var string Section key
    private $key;
    // @var string Section value
    private $value;

    /**
     * Optional constructor
     *
     * @param string|null $key   Section key
     * @param string|null $value Section value
     */ 
    public function __construct($key=null, $value=null)
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
     * @return null
     */ 
    public function setKey($key)
    {
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
     * @return null
     */ 
    public function setValue($value)
    {
        $this->value = (string)$value;
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
     * Return an array representing a Section object for the SendGrid API
     * 
     * @return null|array
     */  
    public function jsonSerialize()
    {
        return array_filter(
            [
                'key'   => $this->getKey(),
                'value'   => $this->getValue()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}