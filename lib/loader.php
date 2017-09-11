<?php
/**
 * Allows us to include one file instead of two when working without composer.
 */
require_once __DIR__ . '/ClientFactory.php';

/**
 * Autoload the helper classes.
 */
spl_autoload_register(function ($class) {
    if ('SendGrid\\' == substr($class, 0, 9)) {
        $class = 'Helpers\\' . substr($class, 9);
    }

    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});
