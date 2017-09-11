<?php

namespace SendGrid\Mail\Setting\Exception;

use SendGrid\SendGrid\Exception\SendGridException;

class SettingIsAlreadySetException extends SendGridException
{
    const ELEMENT = 'Setting';
    const MESSAGE = '%s setting is already set';

    /**
     * @var string
     */
    public $message;

    public function __construct()
    {
        $this->message = sprintf(self::MESSAGE, static::ELEMENT);
    }
}
