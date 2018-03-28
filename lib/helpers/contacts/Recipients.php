<?php
/**
 * This helper builds a html form and provides a submission endpoint for the form that makes a /contactdb/recipients API call.
 *
 * PHP version 5.6, 7
 *
 * @author    Kraig Hufstedler <kraigory@gmail.com>
 * @copyright 2017 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */
namespace SendGrid;

class RecipientForm
{
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

    public function __toString() 
    {
        return $this->html;
    }

}

/**
 * Class for creating a recipient
 */
class Recipient implements \JsonSerializable
{
    private $firstName;
    private $lastName;
    private $email;

    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'email' => $this->getEmail(),
                'first_name' => $this->getFirstName(),
                'last_name' => $this->getLastName()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
