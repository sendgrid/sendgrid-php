<?php

namespace SendGrid\Mail\Setting\Exception;

final class TrackingSettingsIsEmptyException extends SettingIsEmptyException
{
    const ELEMENT = 'Tracking settings';
}
