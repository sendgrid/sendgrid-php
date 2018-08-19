<?php
/**
 * This helper builds the SandBoxMode object for a /mail/send API call
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
 * This class is used to construct a SandBoxMode object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class SandBoxMode implements \JsonSerializable
{
    // @var bool Indicates if this setting is enabled
    private $enable;

    /**
     * Optional constructor
     *
     * @param bool|null $enable Indicates if this setting is enabled
     */
    public function __construct($enable = null)
    {
        if (isset($enable)) {
            $this->setEnable($enable);
        }
    }

    /**
     * Update the enable setting on a SandBoxMode object
     *
     * @param bool $enable Indicates if this setting is enabled
     * 
     * @throws TypeException
     */ 
    public function setEnable($enable)
    {
        if (!is_bool($enable)) {
            throw new TypeException('$enable must be of type bool.');
        }
        $this->enable = $enable;
    }

    /**
     * Retrieve the enable setting on a SandBoxMode object
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Return an array representing a SandBoxMode object for the SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
