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
 * A collection of key/value pairs following the pattern "substitution_tag":"value to 
 * substitute". All are assumed to be strings. These substitutions will apply to the 
 * text and html content of the body of your email, in addition to the subject and 
 * reply-to parameters. The total collective size of your substitutions may not exceed 
 * 10,000 bytes per personalization object
 * 
 * @package SendGrid\Mail
 */
class Substitution implements \JsonSerializable
{
    // @var string Key
    private $key;
    // @var string Value
    private $value;

    public function __construct($key=null, $value=null)
    {
        if(isset($key)) $this->setKey($key);
        if(isset($value)) $this->setValue($value);
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
        $this->value = $value;
    }

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