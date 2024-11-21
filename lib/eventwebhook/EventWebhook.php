<?php

namespace SendGrid\EventWebhook;

use EllipticCurve\Ecdsa;
use EllipticCurve\PublicKey;
use EllipticCurve\Signature;
use EllipticCurve\Utils\Binary;

/**
 * This class allows you to use the Event Webhook feature. Read the docs for
 * more details: https://sendgrid.com/docs/for-developers/tracking-events/event
 *
 * @package SendGrid\EventWebhook
 */
class EventWebhook
{
    /**
     * Convert the public key string to a ECPublicKey.
     *
     * @param string $publicKey verification key under Mail Settings
     * @return PublicKey public key using the ECDSA algorithm
     */
    public function convertPublicKeyToECDSA($publicKey)
    {
        return PublicKey::fromDer(Binary::byteStringFromBase64($publicKey));
    }

    /**
     * Verify signed event webhook requests.
     *
     * @param PublicKey $publicKey elliptic curve public key
     * @param string $payload event payload in the request body
     * @param string $signature value obtained from the
     *                         'X-Twilio-Email-Event-Webhook-Signature' header
     * @param string $timestamp value obtained from the
     *                         'X-Twilio-Email-Event-Webhook-Timestamp' header
     * @return bool true or false if signature is valid
     */
    public function verifySignature($publicKey, $payload, $signature, $timestamp)
    {
        $timestampedPayload = $timestamp . $payload;
        $decodedSignature = Signature::fromBase64($signature);

        return Ecdsa::verify($timestampedPayload, $decodedSignature, $publicKey);
    }
}
