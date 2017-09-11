<?php

namespace SendGrid\Mail\Setting\Exception;

final class BccSettingIsAlreadySetException extends SettingIsAlreadySetException
{
    const ELEMENT = 'Bcc';
}
