<?php
/**
 * This helper builds a html form and provides a submission endpoint
 * for the form that makes a /contactdb/recipients API call.
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
