#!/bin/bash

# From:
# http://raamdev.com/2008/using-curl-to-upload-files-via-post-to-amazon-s3/

GIT_VERSION=`git rev-parse --short HEAD`

rm -rf vendor composer.lock
composer install --no-dev
printf "<?php\nrequire __DIR__ . '/vendor/autoload.php';\n?>" > sendgrid-php.php
cd ..
zip -r sendgrid-php.zip sendgrid-php -x \*.git\* \*composer.json\* \*scripts\* \*test\* \*.travis.yml\* \*prism\*

curl -X POST \
  -H "X-Key: $SECRET_KEY" \
  -F "Content-Type=application/zip" \
  -F "sdk=@./sendgrid-php.zip" \
  https://dx.sendgrid.com/upload

exit 0
