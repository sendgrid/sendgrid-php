<?php
/**
 * This file is used to load the Composer autoloader if required.
 */

use SendGrid\Mail\Mail;

// Define path/existence of Composer autoloader
$composerAutoloadFile = __DIR__ . '/vendor/autoload.php';
$composerAutoloadFileExists = (is_file($composerAutoloadFile));

// Can't locate SendGrid\Mail\Mail class?
if (!class_exists(Mail::class)) {
    // if the user is not using composer, register an autoload function to load based on relative directory structure
    if (!$composerAutoloadFileExists) {
        require_once( __DIR__ . '/lib/BaseSendGridClientInterface.php');
        require_once( __DIR__ . '/lib/SendGrid.php');
        require_once( __DIR__ . '/lib/TwilioEmail.php');

        // autoload based on directory structure & without composer
        spl_autoload_register(function($class){
            if ( starts_with($class, 'SendGrid\\') ){
                $path = str_replace('\\', '/', $class);

                $pieces = explode('/', $path);
                array_shift($pieces); // we don't use the first piece (SendGrid)
                $file = array_pop($pieces);

                $dirPath = __DIR__ . '/lib/' . strtolower(implode('/', $pieces));
                $filePath = $dirPath . '/' . $file . '.php';

                if ( file_exists($filePath) ) {
                    require_once($filePath);
                }

                if ( ! class_exists($class) ) {
                    error_log("Error finding SendGrid class [$class] (expected [$filePath]). Please review your autoloading configuration.");
                }
            }
        });
    } else {
        // Load Composer autoloader
        require_once $composerAutoloadFile;

        // If desired class still not existing
        if (!class_exists(Mail::class)) {
            // Suggest to review the Composer autoloader settings
            error_log("Error finding SendGrid classes. Please review your autoloading configuration.");
        }
    }
}
