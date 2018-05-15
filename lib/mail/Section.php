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

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }
    public function setValue($value)
    {
        $this->value = (string)$value;
    }

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