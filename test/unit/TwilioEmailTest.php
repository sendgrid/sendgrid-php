<?php

namespace SendGrid\Tests\Unit;

use SendGrid\Tests\BaseTestClass;

/**
 * This class tests the Twilio Email Client.
 *
 * @package SendGrid\Tests\Unit
 */
class TwilioEmailTest extends BaseTestClass
{
    /**
     * Test that we can connect to the Twilio Email API.
     */
    public function testCanConnectToTwilioEmailApi()
    {
        $mail = new \TwilioEmail('username', 'password');
        $headers = [
            'Authorization: Basic dXNlcm5hbWU6cGFzc3dvcmQ=',
        ];

        $this->assertEquals('https://email.twilio.com', $mail->client->getHost());
        $this->assertArraySubset($headers, $mail->client->getHeaders());

        $mail = new \TwilioEmail('username', 'password', ['host' => 'https://api.test.com']);
        $this->assertEquals('https://api.test.com', $mail->client->getHost());
    }
}
