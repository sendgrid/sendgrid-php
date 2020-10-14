<?php
/**
 * This helper builds the Cc object for a /mail/send API call
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a Cc object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Cc extends EmailAddress implements \JsonSerializable
{
}
