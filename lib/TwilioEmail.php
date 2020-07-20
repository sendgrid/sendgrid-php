<?php

/**
 * This library allows you to quickly and easily send emails through Twilio
 * SendGrid using PHP.
 *
 * @package SendGrid\Mail
 */
class TwilioEmail extends BaseSendGridClientInterface
{
    /**
     * Set up the HTTP Client.
     *
     * @param string $username Username to authenticate with
     * @param string $password Password to authenticate with
     * @param array $options An array of options, currently only "host", "curl",
     *                       "version", and "impersonateSubuser", are implemented.
     */
    public function __construct($username, $password, $options = array())
    {
        $auth = 'Authorization: Basic ' . \base64_encode("$username:$password");
        $host = 'https://email.twilio.com';
        parent::__construct($auth, $host, $options);
    }
}
