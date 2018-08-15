<?php 
/**
 * This helper builds the DynamicTemplateData object for a /mail/send API call
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
 * This class is used to construct a DynamicTemplateData object for the /mail/send API call 
 * 
 * A collection of key/value pairs following the pattern "dynamic_tag":"value 
 * to substitute". All are assumed to be json encodable. This template data will 
 * apply to the template content of the body of your email. 
 * 
 * @package SendGrid\Mail
 */
class DynamicTemplateData implements \JsonSerializable
{
    // @var string DynamicTemplateData key
    private $key;
    // @var string DynamicTemplateData value
    private $value;

    /**
     * Optional constructor
     *
     * @param string|null $key   DynamicTemplateData key
     * @param string|null $value DynamicTemplateData value
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
     * Add the key on a DynamicTemplateData object
     *
     * @param string $key DynamicTemplateData key
     * 
     * @return null
     */ 
    public function setKey($key)
    {
        $this->key = (string) $key;
    }

    /**
     * Retrieve the key from a DynamicTemplateData object
     * 
     * @return string
     */ 
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Add the value on a DynamicTemplateData object
     *
     * @param string $value DynamicTemplateData value
     * 
     * @return null
     */ 
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Retrieve the value from a DynamicTemplateData object
     * 
     * @return string
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return an array representing a DynamicTemplateData object for the SendGrid API
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
