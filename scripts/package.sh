#!/bin/bash

rm -rf vendor composer.lock
composer install --no-dev
printf "<?php\nrequire __DIR__ . '/vendor/autoload.php';\n?>" > sendgrid-php.php
cd ..
zip -r sendgrid-php.zip sendgrid-php -x \*.git\* \*composer.json\* \*scripts\* \*test\* \*.travis.yml\* \*prism\*

exit 0
