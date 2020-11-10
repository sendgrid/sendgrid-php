<?php
/**
 * This helper builds the Category object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

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
     * @throws \SendGrid\Mail\TypeException
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
     * @throws \SendGrid\Mail\TypeException
     */
    public function setCategory($category)
    {
        Assert::maxLength($category, 'category', 255);

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
