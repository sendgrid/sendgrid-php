<?php

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\EventWebhook\EventWebhook;

/**
 * This class tests the EventWebhook functionality.
 *
 * @package SendGrid\Tests\Unit
 */
class EventWebhookTest extends TestCase
{
    const PUBLIC_KEY = 'MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEEDr2LjtURuePQzplybd
    C+u4CwrqDqBaWjcMMsTbhdbcwHBcepxo7yAQGhHPTnlvFYPAZFceEu/1FwCM/QmGUhA==';
    const PAYLOAD = '{"category":"example_payload","event":"test_event","message_id":"message_id"}';
    const SIGNATURE = 'MEUCIQCtIHJeH93Y+qpYeWrySphQgpNGNr/U+UyUlBkU6n7RAwIgJTz2
    C+8a8xonZGi6BpSzoQsbVRamr2nlxFDWYNH2j/0=';
    const TIMESTAMP = '1588788367';

    public function testVerifySignature()
    {
        $isValidSignature = $this->verify(
            self::PUBLIC_KEY,
            self::PAYLOAD,
            self::SIGNATURE,
            self::TIMESTAMP
        );

        $this->assertTrue($isValidSignature);
    }

    public function testBadKey()
    {
        $isValidSignature = $this->verify(
            'MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEqTxd43gyp8IOEto2LdIfjRQrIbsd4S
            XZkLW6jDutdhXSJCWHw8REntlo7aNDthvj+y7GjUuFDb/R1NGe1OPzpA==',
            self::PAYLOAD,
            self::SIGNATURE,
            self::TIMESTAMP
        );

        $this->assertFalse($isValidSignature);
    }

    public function testBadPayload()
    {
        $isValidSignature = $this->verify(
            self::PUBLIC_KEY,
            'payload',
            self::SIGNATURE,
            self::TIMESTAMP
        );

        $this->assertFalse($isValidSignature);
    }

    public function testBadSignature()
    {
        $isValidSignature = $this->verify(
            self::PUBLIC_KEY,
            self::PAYLOAD,
            'signature',
            self::TIMESTAMP
        );

        $this->assertFalse($isValidSignature);
    }

    public function testBadTimestamp()
    {
        $isValidSignature = $this->verify(
            self::PUBLIC_KEY,
            self::PAYLOAD,
            self::SIGNATURE,
            'timestamp'
        );

        $this->assertFalse($isValidSignature);
    }

    private function verify($publicKey, $payload, $signature, $timestamp)
    {
        $eventWebhook = new EventWebhook();
        $ecPublicKey = $eventWebhook->convertPublicKeyToECDSA($publicKey);
        return $eventWebhook->verifySignature(
            $ecPublicKey,
            $payload,
            $signature,
            $timestamp
        );
    }
}
