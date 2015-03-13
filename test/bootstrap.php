<?php 

include(dirname(dirname(__FILE__)) . '/lib/SendGrid.php');

// Not sure why this is required
include(dirname(dirname(__FILE__)) . '/vendor/eddiezane/tinyhttp/src/TinyHttp.php');

SendGrid::register_autoloader();

function autoload_tests($class) {

  if (strpos($class, 'SendGridTest_') !== 0) {
    return;
  }

  $class = substr($class, 13);
  $file = str_replace('_', '/', $class);
  if (file_exists(dirname(__FILE__) . '/' . $file . '.php')) {
    require_once(dirname(__FILE__) . '/' . $file . '.php');
  }
}

spl_autoload_register('autoload_tests');
