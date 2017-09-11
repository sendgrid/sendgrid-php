<?php
/**
 * This helper builds the request body for a /mail/send API call.
 *
 * PHP version 5.6, 7
 *
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2017 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

class Content implements \JsonSerializable
{
    private $type;
    private $value;

    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setValue($value)
    {
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type'  => $this->getType(),
                'value' => $this->getValue()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
