<?php
/**
 * This helper builds the request body for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

/**
 * This class is used to verify the template id from a request body before /mail/send API call
 *
 * @package SendGrid\Mail
 */
class VerifyTemplateId
{
    private $client;

    private $templateId;

    public function __construct($templateId, $client)
    {
        $this->client = $client;
        $this->templateId = $templateId;
    }

    public function verify()
    {
        $response = $this->client->_('templates/' . $this->templateId)->get()->body();

        if ($response == '') {
            throw new \InvalidArgumentException('The template id ' . $this->templateId . ' is invalid.');
        }

        return true;
    }
}
