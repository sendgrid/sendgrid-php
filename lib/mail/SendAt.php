<?php
/**
 * This helper builds the SendAt object for a /mail/send API call
 */
namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a SendAt object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class SendAt implements \JsonSerializable
{
    /**
     * @var $send_at int A unix timestamp allowing you to specify when you want your email
     * to be delivered. This may be overridden by the personalizations[x].send_at
     * parameter. You can't schedule more than 72 hours in advance. If you have
     * the flexibility, it's better to schedule mail for off-peak times. Most
     * emails are scheduled and sent at the top of the hour or half hour.
     * Scheduling email to avoid those times (for example, scheduling at 10:53) can
     * result in lower deferral rates because it won't be going through our servers
     * at the same times as everyone else's mail
     */
    private $send_at;

    /**
     * Optional constructor
     *
     * @param int|null $send_at A unix timestamp allowing you to specify when you
     *                          want your email to be delivered. This may be
     *                          overridden by the personalizations[x].send_at
     *                          parameter. You can't schedule more than 72 hours
     *                          in advance. If you have the flexibility, it's better
     *                          to schedule mail for off-peak times. Most emails are
     *                          scheduled and sent at the top of the hour or half
     *                          hour. Scheduling email to avoid those times (for
     *                          example, scheduling at 10:53) can result in lower
     *                          deferral rates because it won't be going through
     *                          our servers at the same times as everyone else's mail
     * @throws \SendGrid\Mail\TypeException
     */
    public function __construct($send_at = null)
    {
        if (isset($send_at)) {
            $this->setSendAt($send_at);
        }
    }

    /**
     * Add the send at value to a SendAt object
     *
     * @param int $send_at A unix timestamp allowing you to specify when you
     *                     want your email to be delivered. This may be
     *                     overridden by the personalizations[x].send_at
     *                     parameter. You can't schedule more than 72 hours
     *                     in advance. If you have the flexibility, it's better
     *                     to schedule mail for off-peak times. Most emails are
     *                     scheduled and sent at the top of the hour or half
     *                     hour. Scheduling email to avoid those times (for
     *                     example, scheduling at 10:53) can result in lower
     *                     deferral rates because it won't be going through
     *                     our servers at the same times as everyone else's mail
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setSendAt($send_at)
    {
        Assert::integer($send_at, 'send_at');

        $this->send_at = $send_at;
    }

    /**
     * Retrieve the send at value from a SendAt object
     *
     * @return int
     */
    public function getSendAt()
    {
        return $this->send_at;
    }

    /**
     * Return an array representing a SendAt object for the Twilio SendGrid API
     *
     * @return int
     */
    public function jsonSerialize()
    {
        return $this->getSendAt();
    }
}
