<?php

use SendGrid\EventWebhook\EventWebhook;
use SendGrid\EventWebhook\EventWebhookHeader;


function isValidSignature($request)
{
    $publicKey = 'base64-encoded public key';

    $eventWebhook = new EventWebhook();
    $ecPublicKey = $eventWebhook->convertPublicKeyToECDSA($publicKey);

    return $eventWebhook->verifySignature(
        $ecPublicKey,
        $request->getContent(),
        $request->header(EventWebhookHeader::SIGNATURE),
        $request->header(EventWebhookHeader::TIMESTAMP)
    );
}
