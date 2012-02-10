<?php

define("MOCK_ROOT", __dir__ . DIRECTORY_SEPARATOR);

function mockLoader($string)
{
  if(preg_match("/Mock/", $string))
  {
    $file = str_replace('\\', '/', "$string.php");
    require_once MOCK_ROOT . $file;
  }
}

spl_autoload_register("mockLoader");