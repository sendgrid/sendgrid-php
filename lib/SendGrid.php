<?php
/**
 * This library allows you to quickly and easily send emails through
 * SendGrid using PHP.
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

/**
 * This class is the interface to the SendGrid Web API
 *
 * @package SendGrid\Mail
 */
class SendGrid
{
    const VERSION = '7.2.0';

    // @var string
    protected $namespace = 'SendGrid';

    // @var \SendGrid\Client
    public $client;
    // @var string
    public $version = self::VERSION;

    /**
     * Setup the HTTP Client
     *
     * @param string $apiKey  Your SendGrid API Key.
     * @param array  $options An array of options, currently only "host", "curl" and
     *                        "impersonateSubuser" are implemented.
     */
    public function __construct($apiKey, $options = array())
    {
        $headers = array(
            'Authorization: Bearer '.$apiKey,
            'User-Agent: sendgrid/' . $this->version . ';php',
            'Accept: application/json'
            );

        $host = isset($options['host']) ? $options['host'] :
            'https://api.sendgrid.com';

        if (!empty($options['impersonateSubuser'])) {
            $headers[] = 'On-Behalf-Of: '. $options['impersonateSubuser'];
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
     * Make an API request
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
