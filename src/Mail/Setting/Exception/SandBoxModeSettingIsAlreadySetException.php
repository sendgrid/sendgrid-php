<?php

namespace SendGrid\Mail\Setting\Exception;

final class SandBoxModeSettingIsAlreadySetException extends SettingIsAlreadySetException
{
    const ELEMENT = 'Sandbox mode';
}
