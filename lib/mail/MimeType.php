<?php
/**
 * This helper defines the content mime types for a /mail/send API call
 */

namespace SendGrid\Mail;

/**
 * This class is used to define the content mime types for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
final class MimeType
{
    const HTML = "text/html";
    const TEXT = "text/plain";
}
