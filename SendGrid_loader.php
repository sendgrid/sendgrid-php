<?php

define("ROOT_DIR", __dir__ . DIRECTORY_SEPARATOR);

function sendGridLoader($string)
{
  if(preg_match("/SendGrid/", $string))
  {
    $file = str_replace('\\', '/', "$string.php");
    require_once ROOT_DIR . $file;
    require "vendor/autoload.php";
  }
}

spl_autoload_register("sendGridLoader");