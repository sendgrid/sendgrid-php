#!/bin/bash

# From:
# http://raamdev.com/2008/using-curl-to-upload-files-via-post-to-amazon-s3/

GIT_VERSION=`git rev-parse HEAD`

rm -rf vendor composer.lock
composer install --no-dev
printf "<?php\nrequire 'vendor/autoload.php';\nrequire 'lib/SendGrid.php';\n?>" > sendgrid-php.php
cd ..
zip -r sendgrid-php.zip sendgrid-php -x \*.git\* \*composer\* \*composer.json\* \*scripts\* \*test\* \*.travis.yml\*

echo "CURRENT PATH"
echo $S3_BUCKET
echo $S3_POLICY
echo $GIT_VERSION
pwd

curl -X POST \
  -F "key=sendgrid-php/sendgrid-php.zip" \
  -F "acl=public-read" \
  -F "AWSAccessKeyId=$S3_ACCESS_KEY" \
  -F "Policy=$S3_POLICY" \
  -F "Signature=$S3_SIGNATURE" \
  -F "Content-Type=application/zip" \
  -F "file=@./sendgrid-php.zip" \
  https://s3.amazonaws.com/$S3_BUCKET

curl -X POST \
  -F "key=sendgrid-php/versions/sendgrid-php-$GIT_VERSION.zip" \
  -F "acl=public-read" \
  -F "AWSAccessKeyId=$S3_ACCESS_KEY" \
  -F "Policy=$S3_POLICY" \
  -F "Signature=$S3_SIGNATURE" \
  -F "Content-Type=application/zip" \
  -F "file=@./sendgrid-php.zip" \
  https://s3.amazonaws.com/$S3_BUCKET

exit 0
