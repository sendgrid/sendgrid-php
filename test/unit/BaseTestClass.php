<?php

namespace SendGridPhp\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid;

/**
 * Class BaseTestClass
 */
class BaseTestClass extends TestCase
{
    /**
     * @var string
     */
    protected static $apiKey;
    /**
     * @var SendGrid
     */
    protected static $sg;
    /**
     * @var int
     */
    protected static $pid;

    /**
     * This method is run before the classes are initialised
     */
    public static function setUpBeforeClass()
    {
        self::$apiKey = "SENDGRID_API_KEY";
        $host = ['host' => 'http://localhost:4010'];
        self::$sg = new SendGrid(self::$apiKey, $host);

        if (!is_int(self::$pid)) {
            if (file_exists('/usr/local/bin/prism') == false) {
                if (strtoupper(substr(php_uname('s'), 0, 3)) != 'WIN') {
                    try {
                        $proc_ls = proc_open(
                            "curl https://raw.githubusercontent.com/stoplightio/prism/master/install.sh",
                            [
                                ["pipe", "r"], //stdin
                                ["pipe", "w"], //stdout
                                ["pipe", "w"]  //stderr
                            ],
                            $pipes
                        );
                        $output_ls = stream_get_contents($pipes[1]);
                        fclose($pipes[0]);
                        fclose($pipes[1]);
                        fclose($pipes[2]);
                        $return_value_ls = proc_close($proc_ls);
                        $proc_grep = proc_open(
                            "sh",
                            [
                                ["pipe", "r"], //stdin
                                ["pipe", "w"], //stdout
                                ["pipe", "w"]  //stderr
                            ],
                            $pipes
                        );
                        fwrite($pipes[0], $output_ls);
                        fclose($pipes[0]);
                        $output_grep = stream_get_contents($pipes[1]);
                        fclose($pipes[1]);
                        fclose($pipes[2]);
                        proc_close($proc_grep);
                    } catch (\Exception $e) {
                        print("Error downloading the prism binary, you can try downloading directly here (https://github.com/stoplightio/prism/releases) and place in your /usr/local/bin directory: " . $e->getMessage() . "\n");
                        exit();
                    }
                } else {
                    print("Please download the Windows binary (https://github.com/stoplightio/prism/releases) and place it in your /usr/local/bin directory");
                    exit();
                }
            }

            print("Activating Prism (~20 seconds)\n");
            $command = 'nohup prism run -s https://raw.githubusercontent.com/sendgrid/sendgrid-oai/master/oai_stoplight.json > /dev/null 2>&1 & echo $!';
            exec($command, $op);
            self::$pid = (int)$op[0];
            sleep(15);
            print("\nPrism Started\n\n");
        }
    }
}
