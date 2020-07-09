<?php

namespace SendGrid\EventWebhook;

/**
 * This class lists headers that get posted to the webhook. Read the docs for
 * more details: https://sendgrid.com/docs/for-developers/tracking-events/event
 *
 * @package SendGrid\EventWebhook
 */
final class EventWebhookHeader
{
    const SIGNATURE = "X-Twilio-Email-Event-Webhook-Signature";
    const TIMESTAMP = "X-Twilio-Email-Event-Webhook-Timestamp";
}
