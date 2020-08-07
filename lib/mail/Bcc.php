<?php
/**
 * This helper builds the Bcc object for a /mail/send API call
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a Bcc object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Bcc extends EmailAddress implements \JsonSerializable
{
}
