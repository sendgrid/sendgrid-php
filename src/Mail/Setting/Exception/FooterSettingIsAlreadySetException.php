<?php

namespace SendGrid\Mail\Setting\Exception;

final class FooterSettingIsAlreadySetException extends SettingIsAlreadySetException
{
    const ELEMENT = 'Footer';
}
