<?php
/**
 * This helper builds the Content object for a /mail/send API call
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
     *
     * @throws TypeException
     */
    public function __construct($value)
    {
        parent::__construct(MimeType::HTML, $value);
    }
}
