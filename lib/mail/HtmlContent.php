<?php
/**
 * This helper builds the Content object for a /mail/send API call
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
 * This class is used to construct a Content object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class HtmlContent extends Content
{
    /**
     * Create a Content object with a HTML mime type
     *
     * @param string $value HTML formatted content
     */
    public function __construct($value)
    {
        parent::__construct(MimeType::HTML, $value);
    }
}
