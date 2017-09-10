<?php

namespace SendGrid\SendGrid\Entity;

use SendGrid\Client;
use SendGrid\Response;
use SendGrid\Mail\Mail;

final class SendGrid
{
    const VERSION       = '6.0.0';
    const AUTHORIZATION = 'Authorization: Bearer %s';
    const AGENT         = 'User-Agent: sendgrid/%s;php';
    const ACCEPT        = 'Accept: application/json';
    const DEFAULT_URL   = 'https://api.sendgrid.com';

    /**
     * @var Client
     */
    private $client;

    /**
     * Setup the HTTP Client
     *
     * @param string $apiKey  your SendGrid API Key.
     * @param array  $options an array of Option, currently only "host" and "curl" are implemented.
     */
    public function __construct($apiKey, array $options = [])
    {
        $this->client = $this->createClientFrom($apiKey, $options);
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Mail $mail
     * @return Response
     */
    public function send(Mail $mail)
    {
        return $this->sendUsing($mail);
    }

    /**
     * @param $json
     * @return Response
     */
    public function sendFromJson($json)
    {
        return $this->sendUsing($json);
    }

    /**
     * @param Mail|string $object
     * @return Response
     */
    private function sendUsing($object)
    {
        return $this->client->mail()->send()->post($object);
    }
    /**
     * @param string $apiKey
     * @param array $options
     * @return Client
     */
    private function createClientFrom($apiKey, array $options)
    {
        $this->validateScalar($apiKey);
        $host          = isset($options['host']) ? $options['host'] : self::DEFAULT_URL;
        $curlOptions   = isset($options['curl']) ? $options['curl'] : null;
        return new Client($host, $this->getHeadersFrom($apiKey), '/v3', null, $curlOptions);
    }

    /**
     * @param string $apiKey
     * @return array
     */
    private function getHeadersFrom($apiKey)
    {
        return [
            sprintf(self::AUTHORIZATION, $apiKey),
            sprintf(self::AGENT, self::VERSION),
            self::ACCEPT
        ];
    }

    /**
     * @param $value
     */
    private function validateScalar($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('Api KEY must be a string');
        }
    }
}
