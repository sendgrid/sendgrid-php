<?php
/**
 * This helper builds the Subject object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

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
     *
     * @throws TypeException
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
        Assert::minLength($subject, 'subject', 1);

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
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->getSubject();
    }
}
