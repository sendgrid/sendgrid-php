<?php

namespace SendGrid\Mail\Setting\Exception;

use SendGrid\SendGrid\Exception\SendGridException;

class SettingIsEmptyException extends SendGridException
{
    const ELEMENT = 'Settings';
    const MESSAGE = '%s should contain at least one setting';

    /**
     * @var string
     */
    public $message;

    public function __construct()
    {
        $this->message = sprintf(self::MESSAGE, static::ELEMENT);
    }
}
