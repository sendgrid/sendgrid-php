<?php

/**
 * This class is the base interface to the Twilio SendGrid Web API.
 *
 * @package SendGrid\Mail
 */
class BaseSendGridClientInterface
{
    const VERSION = '7.5.2';

    // @var \SendGrid\Client
    public $client;
    // @var string
    public $version = self::VERSION;

    /**
     * Set up the HTTP Client.
     *
     * @param string $auth Authorization header value.
     * @param string $host Default host/base URL for the client.
     * @param array $options An array of options, currently only "host", "curl", and
     *                       "impersonateSubuser" are implemented.
     */
    public function __construct($auth, $host, $options = array())
    {
        $headers = [
            $auth,
            'User-Agent: sendgrid/' . $this->version . ';php',
            'Accept: application/json',
        ];

        $host = isset($options['host']) ? $options['host'] : $host;

        if (!empty($options['impersonateSubuser'])) {
            $headers[] = 'On-Behalf-Of: ' . $options['impersonateSubuser'];
        }

        $curlOptions = isset($options['curl']) ? $options['curl'] : null;

        $this->client = new \SendGrid\Client(
            $host,
            $headers,
            '/v3',
            null,
            $curlOptions
        );
    }

    /**
     * Make an API request.
     *
     * @param \SendGrid\Mail\Mail $email A Mail object, containing the request object
     *
     * @return \SendGrid\Response
     */
    public function send(\SendGrid\Mail\Mail $email)
    {
        return $this->client->mail()->send()->post($email);
    }
}
