<?php 
/**
 * This helper builds the Substitution object for a /mail/send API call
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
    // @var string Substitution key
    private $key;
    // @var string Substitution value
    private $value;

    /**
     * Optional constructor
     *
     * @param string|null $key   Substitution key
     * @param string|null $value Substitution value
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
     * Add the key on a Substitution object
     *
     * @param string $key Substitution key
     * 
     * @return null
     */ 
    public function setKey($key)
    {
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
     * @param string $value Substitution value
     * 
     * @return null
     */ 
    public function setValue($value)
    {
        $this->value = (string) $value;
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
     * Return an array representing a Substitution object for the SendGrid API
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