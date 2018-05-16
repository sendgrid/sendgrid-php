<?php 
/**
 * This helper builds the IpPoolName object for a /mail/send API call
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
 * This class is used to construct a IpPoolName object for the /mail/send API call
 * 
 * @package SendGrid\Mail
 */
class IpPoolName implements \JsonSerializable
{
    // @var string The IP Pool that you would like to send this email from. 
    // Minimum length: 2, Maximum Length: 64
    private $ip_pool_name;

    /**
     * Optional constructor
     *
     * @param string|null $ip_pool_name The IP Pool that you would like to 
     *                                  send this email from. Minimum length: 
     *                                  2, Maximum Length: 64
     */ 
    public function __construct($ip_pool_name=null)
    {
        if (isset($ip_pool_name)) {
            $this->setIpPoolName($ip_pool_name);
        }
    }

    /**
     * Set the ip pool name on a IpPoolName object
     *
     * @param string $ip_pool_name The IP Pool that you would like to 
     *                             send this email from. Minimum length: 
     *                             2, Maximum Length: 64
     * 
     * @return null
     */ 
    public function setIpPoolName($ip_pool_name)
    {
        $this->ip_pool_name = $ip_pool_name;
    }

    /**
     * Retrieve the ip pool name from a IpPoolName object
     * 
     * @return string
     */ 
    public function getIpPoolName()
    {
        return $this->ip_pool_name;
    }

    /**
     * Return an array representing a IpPoolName object for the SendGrid API
     * 
     * @return null|array
     */  
    public function jsonSerialize()
    {
        return $this->getIpPoolName();
    }
}