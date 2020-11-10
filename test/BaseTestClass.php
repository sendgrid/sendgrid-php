<?php
/**
 * This file contains the base class for testing the request object
 * generation for a /mail/send API call
 */
namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid;
use Swaggest\JsonDiff\Exception;
use Swaggest\JsonDiff\JsonDiff;
use Swaggest\JsonDiff\JsonPatch;

/**
 * This class facilitates testing the request object
 * generation for a /mail/send API call
 *
 * @package SendGrid\Mail
 */
class BaseTestClass extends TestCase
{
    /** @var string Twilio SendGrid API Key */
    protected static $apiKey;
    /** @var SendGrid Twilio SendGrid client */
    protected static $sg;

    /**
     * This method is run before the classes are initialised
     *
     * @return null
     */
    public static function setUpBeforeClass()
    {
        self::$apiKey = 'SENDGRID_API_KEY';
        self::$sg = new SendGrid(self::$apiKey);
    }

    /**
     * Compares to JSON objects and returns True if equal,
     * else return array of differences
     *
     * @param string $json1 A string representation of a JSON object
     * @param string $json2 A string representation of a JSON object
     *
     * @return bool|array
     * @throws \Swaggest\JsonDiff\Exception
     */
    public static function compareJSONObjects($json1, $json2)
    {
        $diff = new JsonDiff(
            json_decode($json1),
            json_decode($json2),
            JsonDiff::REARRANGE_ARRAYS
        );
        $patch = $diff->getPatch();
        $patch_array = JsonPatch::export($patch);
        if (empty($patch_array)) {
            return true;
        }

        return $patch_array;
    }
}
