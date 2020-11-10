<?php

/**
 * This library allows you to quickly and easily send emails through Twilio
 * SendGrid using PHP.
 *
 * @package SendGrid\Mail
 */
class SendGrid extends BaseSendGridClientInterface
{
    /**
     * Set up the HTTP Client.
     *
     * @param string $apiKey Your Twilio SendGrid API Key.
     * @param array $options An array of options, currently only "host", "curl",
     *                       "version", "verify_ssl", and "impersonateSubuser",
     *                       are implemented.
     */
    public function __construct($apiKey, $options = array())
    {
        $auth = 'Authorization: Bearer ' . $apiKey;
        $host = 'https://api.sendgrid.com';
        parent::__construct($auth, $host, $options);
    }
}
