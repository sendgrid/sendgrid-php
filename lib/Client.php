<?php

require 'resources/api_keys.php';
require 'resources/asm_groups.php';
require 'resources/asm_suppressions.php';
require 'resources/global_stats.php';

class Client
{
    const VERSION = '4.0.2';

    protected
        $namespace = 'SendGrid',
        $client,
        $options;

    public
        $apiKey,
        $url,
        $endpoint,
        $api_keys,
        $asm_groups,
        $asm_suppressions,
        $version = self::VERSION;

    public function __construct($apiKey, $options = array())
    {
        // Check if api key is present
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
        $this->asm_groups = new ASMGroups($this);
        $this->asm_suppressions = new ASMSuppressions($this);
        $this->global_stats = new GlobalStats($this);
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

        $guzzleOption['request.options']['headers'] = array('Authorization' => 'Bearer ' . $this->apiKey, 'Content-Type' => 'application/json', 'Accept'=> '*/*');

        // Using http proxy
        if (isset($this->options['proxy'])) {
            $guzzleOption['request.options']['proxy'] = $this->options['proxy'];
        }

        $client = new \Guzzle\Http\Client($this->url, $guzzleOption);
        $client->setUserAgent('sendgrid/' . $this->version . ';php');

        return $client;
    }
    
    public function setClient($client)
    {
      $this->client = $client;
    }

    /**
     * The following *Request functions make the HTTP API requests to SendGrid
     *
     * @param $api is an endpoint object defined in the resources 
     * @param $data is array of parameters
     *
     * @return Guzzle Response object: http://guzzle3.readthedocs.org/http-client/response.html
     */
    
    public function postRequest($api, $data)
    {
        $url = $this->url . $api->getEndpoint();
        $response = $this->client->post($url, null, json_encode($data))->send();
        return $response;
    }
  
    public function patchRequest($api, $data)
    {
        $url = $this->url . $api->getEndpoint();
        $response = $this->client->patch($url, null, json_encode($data))->send();
        return $response;
    }
    
    public function getRequest($api){
        $url = $this->url . $api->getEndpoint();
        $response = $this->client->get($url)->send();
        return $response;
    }

    public function deleteRequest($api){
        $url = $this->url . $api->getEndpoint();
        $response = $this->client->delete($url)->send();
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
