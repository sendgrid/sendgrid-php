<?php
/**
 * This helper builds the Category object for a /mail/send API call
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
 * This class is used to construct a Category object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Category implements \JsonSerializable
{
    /** @var $category string A category name for an email message. Each category name may not exceed 255 characters */
    private $category;

    /**
     * Optional constructor
     *
     * @param string|null $category A category name for an email message.
     *                              Each category name may not exceed 255
     *                              characters
     */
    public function __construct($category = null)
    {
        if (isset($category)) {
            $this->setCategory($category);
        }
    }

    /**
     * Add a category to a Category object
     *
     * @param string $category A category name for an email message.
     *                         Each category name may not exceed 255
     *                         characters
     *
     * @throws TypeException
     */ 
    public function setCategory($category)
    {
        if (!is_string($category)) {
            throw new TypeException('$category must be of type string.');
        }
        $this->category = $category;
    }

    /**
     * Retrieve a category from a Category object
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Return an array representing a Category object for the Twilio SendGrid API
     *
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->getCategory();
    }
}
