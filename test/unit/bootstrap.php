<?php
require __DIR__ . '/../../vendor/autoload.php';
include(dirname(dirname(__FILE__)) . '/../lib/SendGrid.php');
include(dirname(dirname(__FILE__)) . '/../lib/helpers/mail/Mail.php');

SendGrid::register_autoloader();

function autoload_tests($class)
{
    if (strpos($class, 'SendGridTest_') !== 0) {
        return;
    }

    if (strpos($class, 'MailTest_') !== 0) {
        return;
    }

    $class = substr($class, 13);
    $file = str_replace('_', '/', $class);
    if (file_exists(dirname(__FILE__) . '/' . $file . '.php')) {
        require_once(dirname(__FILE__) . '/' . $file . '.php');
    }
}

spl_autoload_register('autoload_tests');