<?php
/**
 * This helper builds the IpPoolName object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a IpPoolName object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class IpPoolName implements \JsonSerializable
{
    /**
     * @var $ip_pool_name string The IP Pool that you would like to send
     *                           this email from.
     *                           Minimum length: 2, Maximum Length: 64
     */
    private $ip_pool_name;

    /**
     * Optional constructor
     *
     * @param string|null $ip_pool_name The IP Pool that you would like to
     *                                  send this email from. Minimum length:
     *                                  2, Maximum Length: 64
     * @throws \SendGrid\Mail\TypeException
     */
    public function __construct($ip_pool_name = null)
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
     * @throws \SendGrid\Mail\TypeException
     */
    public function setIpPoolName($ip_pool_name)
    {
        Assert::minLength($ip_pool_name, 'ip_pool_name', 2);
        Assert::maxLength($ip_pool_name, 'ip_pool_name', 64);

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
     * Return an array representing a IpPoolName object for the Twilio SendGrid API
     *
     * @return string
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->getIpPoolName();
    }
}
