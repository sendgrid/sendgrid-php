#!/bin/bash

# From:
# http://raamdev.com/2008/using-curl-to-upload-files-via-post-to-amazon-s3/

GIT_VERSION=`git describe`

rm -rf vendor composer.lock
composer install --no-dev
echo "require 'vendor/autoload.php';\nrequire 'lib/SendGrid.php';" > sendgrid-php.php
rm composer.json composer.lock scripts test
cd ..
zip -r sendgrid-php.zip sendgrid-php

echo "CURRENT PATH"
pwd

curl \
  -F "key=sendgrid-php.zip" \
  -F "acl=public-read" \
  -F "AWSAccessKeyId=$S3_ACCESS_KEY" \
  -F "Policy=$S3_POLICY" \
  -F "Signature=$S3_SIGNATURE" \
  -F "Content-Type=application/zip" \
  -F "file=@./sendgrid-php.zip" \
  https://s3.amazonaws.com/$S3_BUCKET

exit 0
