<?php

require 'resources/api_keys.php';

class Client
{
    const VERSION = '4.0.0';

    protected
        $namespace = 'SendGrid',
        $headers = array('Content-Type' => 'application/json'),
        $client,
        $options;

    public
        $apiKey,
        $url,
        $endpoint,
        $api_keys,
        $version = self::VERSION;

    public function __construct($apiKey, $options = array())
    {
        // Check if given a username + password or api key
        if (is_string($apiKey)) {
            $this->apiKey = $apiKey;
            $this->options = $options;
        } else {
            throw new InvalidArgumentException('Need an api key!');
        }

        $this->options['turn_off_ssl_verification'] = (isset($this->options['turn_off_ssl_verification']) && $this->options['turn_off_ssl_verification'] == true);
        if (!isset($this->options['raise_exceptions'])) {
            $this->options['raise_exceptions'] = true;
        }
        $protocol = isset($this->options['protocol']) ? $this->options['protocol'] : 'https';
        $host = isset($this->options['host']) ? $this->options['host'] : 'api.sendgrid.com';
        $port = isset($this->options['port']) ? $this->options['port'] : '';

        $this->url = isset($this->options['url']) ? $this->options['url'] : $protocol . '://' . $host . ($port ? ':' . $port : '');
        if (isset($this->options['endpoint'])) {
          $this->endpoint = $this->options['endpoint'];
        }
        $this->client = $this->prepareHttpClient();
        $this->api_keys = new APIKeys($this);
    }

    /**
     * Prepares the HTTP client
     *
     * @return \Guzzle\Http\Client
     */
    private function prepareHttpClient()
    {
        $guzzleOption = array(
            'request.options' => array(
                'verify' => !$this->options['turn_off_ssl_verification'],
                'exceptions' => (isset($this->options['enable_guzzle_exceptions']) && $this->options['enable_guzzle_exceptions'] == true)
            )
        );

        $guzzleOption['request.options']['headers'] = array('Authorization' => 'Bearer ' . $this->apiKey);

        // Using http proxy
        if (isset($this->options['proxy'])) {
            $guzzleOption['request.options']['proxy'] = $this->options['proxy'];
        }

        $client = new \Guzzle\Http\Client($this->url, $guzzleOption);
        $client->setUserAgent('sendgrid/' . $this->version . ';php');

        return $client;
    }

    /**
     * Makes the actual HTTP request to SendGrid
     *
     * @param $endpoint string endpoint to post to
     * @param $form array web ready version of SendGrid\Email
     *
     * @return SendGrid\Response
     */
    public function postRequest($endpoint, $form)
    {
        $req = $this->client->post($endpoint, null, $form);

        $res = $req->send();

        $response = new SendGrid\Response($res->getStatusCode(), $res->getHeaders(), $res->getBody(true), $res->json());

        return $response;
    }
    
    public function getRequest($api){
      $url = $this->url . $api->getEndpoint();
      $response = $this->client->get($url)->send();
      return $response;
    }

    public static function register_autoloader()
    {
        spl_autoload_register(array('Client', 'autoloader'));
    }

    public static function autoloader($class)
    {
        // Check that the class starts with 'Client'
        if ($class == 'Client' || stripos($class, 'Client\\') === 0) {
            $file = str_replace('\\', '/', $class);

            if (file_exists(dirname(__FILE__) . '/' . $file . '.php')) {
                require_once(dirname(__FILE__) . '/' . $file . '.php');
            }
        }
    }
}
