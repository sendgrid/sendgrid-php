<?php

namespace SendGrid\Mail\Setting\Exception;

final class ByPassListManagementSettingIsAlreadySetException extends SettingIsAlreadySetException
{
    const ELEMENT = 'Bypass list management';
}
