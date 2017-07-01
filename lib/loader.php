<?php
/**
 * Allows us to include one file instead of two when working without composer.
 */
require_once __DIR__ . '/SendGrid.php';

/**
 * Autoload the helper classes.
 */
spl_autoload_register(function ($class) {
    require_once __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
});
