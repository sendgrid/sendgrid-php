<?php
/**
 * This helper builds the From object for a /mail/send API call
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a From object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class From extends EmailAddress implements \JsonSerializable
{
}
