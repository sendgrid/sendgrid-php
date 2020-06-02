<?php

use SendGrid\Client;
use SendGrid\Mail\Mail;
use SendGrid\Response;

/**
 * This class is the base interface to the Twilio SendGrid Web API.
 *
 * @package SendGrid\Mail
 */
abstract class BaseSendGridClientInterface
{
    /** @var string SendGrid API library version */
    const VERSION = '7.5.2';

    /** @var Client SendGrid HTTP Client library */
    public $client;

    /** @var string SendGrid version */
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

        $this->client = new Client(
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
     * @param Mail $email A Mail object, containing the request object
     *
     * @return Response
     */
    public function send(Mail $email)
    {
        return $this->client->mail()->send()->post($email);
    }
}
