<?php

define("ROOT_DIR", __dir__ . DIRECTORY_SEPARATOR);

function __autoload($string)
{
  $file = str_replace('\\', '/', "$string.php");
  require ROOT_DIR . $file;
}
