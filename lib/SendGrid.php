<?php
/**
  * This library allows you to quickly and easily send emails through SendGrid using PHP.
  *
  * @author    Elmer Thomas <dx@sendgrid.com>
  * @copyright 2017 SendGrid
  * @license   https://opensource.org/licenses/MIT The MIT License
  * @version   GIT: <git_id>
  * @link      http://packagist.org/packages/sendgrid/sendgrid
  */

/**
  * Interface to the SendGrid Web API
  */
class SendGrid
{
    const VERSION = '5.4.2';

    /**
     *
     * @var string
     */
    protected $namespace = 'SendGrid';

    /**
     * @var \SendGrid\Client
     */
    public $client;

    /**
     * @var string
     */
    public $version = self::VERSION;

    /**
      * Setup the HTTP Client
      *
      * @param string $apiKey  your SendGrid API Key.
      * @param array  $options an array of options, currently only "host" and "curl" are implemented.
      */
    public function __construct($apiKey, $options = array())
    {
        $headers = array(
            'Authorization: Bearer '.$apiKey,
            'User-Agent: sendgrid/' . $this->version . ';php',
            'Accept: application/json'
            );

        $host = isset($options['host']) ? $options['host'] : 'https://api.sendgrid.com';

        $curlOptions = isset($options['curl']) ? $options['curl'] : null;

        $this->client = new \SendGrid\Client($host, $headers, '/v3', null, $curlOptions);
    }
}
