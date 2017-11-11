You can use Docker to easily try out or test sendgrid-python.

<a name="Quickstart"></a>
# Quickstart

1. Install Docker on your machine
2. Run `docker run -it sendgrid/sendgrid-php`.

<a name="Info"></a>
# Info

This Docker image contains
 - `sendgrid-php` and `php-http-client`
 - Stoplight's Prism, which lets you try out the API without actually sending email
 - A complete setup for testing the repository or your own fork

You can mount repositories in the `/mnt/sendgrid-php` and `/mnt/php-http-client` directories to use them instead of the default SendGrid libraries.  Read on for more info.


## Specifying a version

To use a different version of sendgrid-php or php-http-client - for instance, to replicate your production setup - mount it with the `-v <host_dir>:<container_dir>` option.  When you put either repository under `/mnt`, the container will automatically detect it and make the proper symlinks.

For instance, to install sendgrid-php v5.6.1 with an older version of php-http-client:

    $ git clone https://github.com/sendgrid/sendgrid-php.git --branch v5.6.1
    $ realpath sendgrid-php
      /path/to/sendgrid-php
    $ git clone https://github.com/sendgrid/php-http-client.git --branch v3.5.1
    $ realpath php-http-client
      /path/to/php-http-client
    $ docker run -it -v /path/to/sendgrid-php:/mnt/sendgrid-php \
                     -v /path/to/php-http-client:/mnt/php-http-client \
                     sendgrid/sendgrid-php

## To install your own version:

    $ git clone https://github.com/you/cool-sendgrid-php.git
    $ realpath sendgrid-php
      /path/to/cool-sendgrid-php
    $ docker run -it -v /path/to/cool-sendgrid-php:/mnt/sendgrid-php sendgrid/sendgrid-php

Note that the paths you specify in `-v` must be absolute.

<a name="Testing"></a>
# Testing
Testing is easy!  Run the container, `cd sendgrid`, and run `vendor/bin/phpunit tests`.
