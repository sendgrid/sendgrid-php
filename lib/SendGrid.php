<?php

use GuzzleHttp\Exception\ClientException;

class SendGrid {
    const VERSION = '3.2.0';

    protected
        $namespace = 'SendGrid',
        $headers = array('Content-Type' => 'application/json'),
        $client,
        $options;

    public
        $apiUser,
        $apiKey,
        $url,
        $endpoint,
        $version = self::VERSION;

    public function __construct($apiUserOrKey, $apiKeyOrOptions = NULL, $options = array()) {
        // Check if given a username + password or api key.
        if (is_string($apiKeyOrOptions)) {
            // Username and password.
            $this->apiUser = $apiUserOrKey;
            $this->apiKey = $apiKeyOrOptions;
            $this->options = $options;
        }
        elseif (is_array($apiKeyOrOptions) || $apiKeyOrOptions === NULL) {
            // API key.
            $this->apiKey = $apiUserOrKey;
            $this->apiUser = NULL;

            // With options.
            if (is_array($apiKeyOrOptions)) {
                $this->options = $apiKeyOrOptions;
            }
        }
        else {
            // Won't be thrown?
            throw new InvalidArgumentException('Need a username + password or api key!');
        }

        $this->options['turn_off_ssl_verification'] = (isset($this->options['turn_off_ssl_verification']) && $this->options['turn_off_ssl_verification'] == TRUE);
        if (!isset($this->options['raise_exceptions'])) {
            $this->options['raise_exceptions'] = TRUE;
        }
        $protocol = isset($this->options['protocol']) ? $this->options['protocol'] : 'https';
        $host = isset($this->options['host']) ? $this->options['host'] : 'api.sendgrid.com/api/';
        $port = isset($this->options['port']) ? $this->options['port'] : '';

        $this->url = isset($this->options['url']) ? $this->options['url'] : $protocol . '://' . $host . ($port ? ':' . $port : '');
        $this->endpoint = isset($this->options['endpoint']) ? $this->options['endpoint'] : 'mail.send.json';

        $this->client = $this->prepareHttpClient();
    }

    /**
     * Prepares the HTTP client
     *
     * @return \GuzzleHttp\Client
     */
    private function prepareHttpClient() {
        $headers = array();
        // $headers['verify'] = !$this->options['turn_off_ssl_verification'];
        // Using api key
        if ($this->apiUser === NULL) {
            $headers['Authorization'] = 'Bearer' . ' ' . $this->apiKey;
        }
        // @TODO Handle a username and password.

        // Using http proxy
        if (isset($this->options['proxy'])) {
            $headers['proxy'] = $this->options['proxy'];
        }
        $headers['User-Agent'] = 'sendgrid/' . $this->version . ';php';
        // Create an empty stack for error processing.
        // Guzzlehttp will choose the most appropriate handler based on the system.
        $stack = \GuzzleHttp\HandlerStack::create();

        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->url,
            'headers' => $headers,
            'handler' => $stack
        ]);
        return $client;
    }

    /**
     * @return array The protected options array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Makes a post request to SendGrid to send an email
     *
     * @param SendGrid\Email $email Email object built
     *
     * @throws SendGrid\Exception if the response code is not 200
     * @return stdClass SendGrid response object
     */
    public function send(SendGrid\Email $email) {
        $form = $email->toWebFormat();
        //$this->request = new \GuzzleHttp\Psr7\Request('POST', $this->url . $this->endpoint);
        // @TODO Add username/password to the header.
        // Using username password
        if ($this->apiUser !== NULL) {
            $form['api_user'] = $this->apiUser;
            $form['api_key'] = $this->apiKey;
        }

        $response = $this->postRequest($this->endpoint, $form);

        if ($response->code != 200 && $this->options['raise_exceptions']) {
            throw new SendGrid\Exception($response->raw_body, $response->code);
        }

        return $response;
    }

    /**
     * Makes the actual HTTP request to SendGrid
     *
     * @param $endpoint string endpoint to post to
     * @param $form array web ready version of SendGrid\Email
     *
     * @return SendGrid\Response
     */
    public function postRequest($endpoint, $form) {
        try {
            $res = $this->client->post($endpoint, ['query' => $form]);
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            echo 'Sendgrid API has experienced and error completing your request.';
            var_dump($e);
            return FALSE;
        }
        $response = new SendGrid\Response($res->getStatusCode(), $res->getHeaders(), $res->getBody(TRUE), json_decode($res->getBody(TRUE)));

        return $response;
    }

    public static function register_autoloader() {
        spl_autoload_register(array('SendGrid', 'autoloader'));
    }

    public static function autoloader($class) {
        // Check that the class starts with 'SendGrid'
        if ($class == 'SendGrid' || stripos($class, 'SendGrid\\') === 0) {
            $file = str_replace('\\', '/', $class);

            if (file_exists(dirname(__FILE__) . '/' . $file . '.php')) {
                require_once(dirname(__FILE__) . '/' . $file . '.php');
            }
        }
    }
}
