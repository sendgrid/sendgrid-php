<?php

namespace SendGrid\Mail\Setting\Exception;

final class SubscriptionTrackingSettingIsAlreadySetException extends SettingIsAlreadySetException
{
    const ELEMENT = 'Subscription tracking';
}
