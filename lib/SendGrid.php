<?php
/**
  * This library allows you to quickly and easily send emails through SendGrid using PHP.
  *
  * PHP version 5.3
  *
  * @author    Elmer Thomas <dx@sendgrid.com>
  * @copyright 2016 SendGrid
  * @license   https://opensource.org/licenses/MIT The MIT License
  * @version   GIT: <git_id>
  * @link      http://packagist.org/packages/sendgrid/sendgrid
  */
namespace SendGrid;

require dirname(__DIR__).'/vendor/autoload.php';
if(getenv('TRAVIS')) {
    require dirname(__DIR__).'/vendor/sendgrid/php-http-client/lib/SendGrid/client.php';
}

/**
  * Interface to the SendGrid Web API
  */
class SendGrid
{
    const VERSION = '5.0.0';

    protected
        $namespace = 'SendGrid';

    public
        $client,
        $version = self::VERSION;

    /**
      * Setup the HTTP Client
      *
      * @param string $apiKey  your SendGrid API Key.
      * @param array  $options an array of options, currenlty only "host" is implemented.
      */
    public function __construct($apiKey, $options = array())
    {
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$apiKey,
            'User-Agent: sendgrid/' . $this->version . ';php'
            );
        $host = isset($options['host']) ? $options['host'] : 'https://api.sendgrid.com';
        $this->client = new Client($host, $headers, '/v3', null);
    }

    public static function register_autoloader()
    {
        spl_autoload_register(array('SendGrid', 'autoloader'));
    }

    public static function autoloader($class)
    {
        // Check that the class starts with 'SendGrid'
        if ($class == 'SendGrid' || stripos($class, 'SendGrid\\') === 0) {
            $file = str_replace('\\', '/', $class);
            if (file_exists(dirname(__FILE__) . '/' . $file . '.php')) {
                require_once(dirname(__FILE__) . '/' . $file . '.php');
            }
        }
    }

}
