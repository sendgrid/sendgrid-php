<?php
/**
 * This helper builds the ReplyTo object for a /mail/send API call
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a ReplyTo object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class ReplyTo extends EmailAddress implements \JsonSerializable
{
}
