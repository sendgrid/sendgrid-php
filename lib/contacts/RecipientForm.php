<?php
/**
 * This helper builds a html form and provides a submission endpoint
 * for the form that makes a /contactdb/recipients API call.
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Contacts
 * @author    Kraig Hufstedler <kraigory@gmail.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Contacts;

/**
 * This class is used to build a html form and provides a submission
 * endpoint for the form that makes a /contactdb/recipients API call.
 *
 * @package SendGrid\Contacts
 */
class RecipientForm
{
    /** @var $html string HTML content for the form */
    private $html;

    /**
     * Form constructor
     *
     * @param string $url The url the form should submit to
     */
    public function __construct($url)
    {
        $html = '<form action="' . $url . '" method="post">
    First Name: <input type="text" name="first-name"><br>
    Last Name: <input type="text" name="last-name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="submit">
</form>';
        $this->html = $html;
    }

    /**
     * Return the HTML form
     *
     * @return string
     */
    public function __toString()
    {
        return $this->html;
    }

}
