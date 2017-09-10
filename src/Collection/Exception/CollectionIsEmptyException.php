<?php

namespace SendGrid\Collection\Exception;

use SendGrid\SendGrid\Exception\SendGridException;

class CollectionIsEmptyException extends SendGridException
{
    const ELEMENT = 'element';
    const MESSAGE = 'Collection should contain at least one %s';

    /**
     * @var string
     */
    public $message;

    public function __construct()
    {
        $this->message = sprintf(self::MESSAGE, static::ELEMENT);
    }
}
