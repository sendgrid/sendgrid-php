<?php

namespace SendGrid\Mail\Setting\Exception;

final class ClickTrackingIsAlreadySetException extends SettingIsAlreadySetException
{
    const ELEMENT = 'Click tracking';
}
