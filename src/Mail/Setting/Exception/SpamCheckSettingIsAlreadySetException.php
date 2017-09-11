<?php

namespace SendGrid\Mail\Setting\Exception;

final class SpamCheckSettingIsAlreadySetException extends SettingIsAlreadySetException
{
    const ELEMENT = 'Spam check';
}
