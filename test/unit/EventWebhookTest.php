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
    private static $PUBLIC_KEY;
    private static $SIGNATURE;
    private static $TIMESTAMP;
    private static $PAYLOAD;

    public static function setUpBeforeClass()
    {
        self::$PUBLIC_KEY = 'MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAE83T4O/n84iotIv
        IW4mdBgQ/7dAfSmpqIM8kF9mN1flpVKS3GRqe62gw+2fNNRaINXvVpiglSI8eNEc6wEA3F+g==';
        self::$SIGNATURE = 'MEUCIGHQVtGj+Y3LkG9fLcxf3qfI10QysgDWmMOVmxG0u6ZUAiE
        AyBiXDWzM+uOe5W0JuG+luQAbPIqHh89M15TluLtEZtM=';
        self::$TIMESTAMP = '1600112502';
        self::$PAYLOAD = \json_encode(
                [
                    [
                        'email' => 'hello@world.com',
                        'event' => 'dropped',
                        'reason' => 'Bounced Address',
                        'sg_event_id' => 'ZHJvcC0xMDk5NDkxOS1MUnpYbF9OSFN0T0doUTRrb2ZTbV9BLTA',
                        'sg_message_id' => 'LRzXl_NHStOGhQ4kofSm_A.filterdrecv-p3mdw1-756b745b58-kmzbl-18-5F5FC76C-9.0',
                        'smtp-id' => '<LRzXl_NHStOGhQ4kofSm_A@ismtpd0039p1iad1.sendgrid.net>',
                        'timestamp' => 1600112492,
                    ]
                ]
            ) . "\r\n"; // Be sure to include the trailing carriage return and newline!
    }

    public function testVerifySignature()
    {
        $isValidSignature = $this->verify(
            self::$PUBLIC_KEY,
            self::$PAYLOAD,
            self::$SIGNATURE,
            self::$TIMESTAMP
        );

        self::assertTrue($isValidSignature);
    }

    public function testBadKey()
    {
        $isValidSignature = $this->verify(
            'MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEqTxd43gyp8IOEto2LdIfjRQrIbsd4S
            XZkLW6jDutdhXSJCWHw8REntlo7aNDthvj+y7GjUuFDb/R1NGe1OPzpA==',
            self::$PAYLOAD,
            self::$SIGNATURE,
            self::$TIMESTAMP
        );

        self::assertFalse($isValidSignature);
    }

    public function testBadPayload()
    {
        $isValidSignature = $this->verify(
            self::$PUBLIC_KEY,
            'payload',
            self::$SIGNATURE,
            self::$TIMESTAMP
        );

        self::assertFalse($isValidSignature);
    }

    public function testBadSignature()
    {
        $isValidSignature = $this->verify(
            self::$PUBLIC_KEY,
            self::$PAYLOAD,
            'signature',
            self::$TIMESTAMP
        );

        self::assertFalse($isValidSignature);
    }

    public function testBadTimestamp()
    {
        $isValidSignature = $this->verify(
            self::$PUBLIC_KEY,
            self::$PAYLOAD,
            self::$SIGNATURE,
            'timestamp'
        );

        self::assertFalse($isValidSignature);
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
