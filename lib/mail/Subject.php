<?php
/**
 * This helper builds the Subject object for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a Subject object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Subject implements \JsonSerializable
{
    /** @var $subject string The email subject */
    private $subject;

    /**
     * Optional constructor
     *
     * @param string|null $subject The email subject
     */
    public function __construct($subject = null)
    {
        if (isset($subject)) {
            $this->setSubject($subject);
        }
    }

    /**
     * Set the subject on a Subject object
     *
     * @param string $subject The email subject
     * 
     * @throws TypeException
     */ 
    public function setSubject($subject)
    {
        if (!is_string($subject)) {
            throw new TypeException('$subject must be of type string.');
        }

        $this->subject = $subject;
    }

    /**
     * Retrieve the subject from a Subject object
     *
     * @return string
     */
    public function getSubject()
    {
        return mb_convert_encoding($this->subject, 'UTF-8', 'UTF-8');
    }

    /**
     * Return an array representing a Subject object for the Twilio SendGrid API
     *
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->getSubject();
    }
}
