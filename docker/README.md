Use Docker to easily try out or contribute to the sendgrid-php library. 

This Docker image contains:
 - PHP 7.1
 - A running instance of [Stoplight.io's Prism](https://stoplight.io/platform/prism/), which lets you try out the SendGrid API without actually sending email
 - A mirrored copy of sendgrid-php so that you may develop locally and then run the tests within the Docker container.

# Table of Contents

* [Quick Start](#quick-start)
* [Testing](#testing)
* [Contributing](#contributing)

<a name="quick-start"></a>
# Quick Start

0. Install Composer:
  - `php -r "readfile('https://getcomposer.org/installer');" | php`
  - `mv composer.phar /usr/local/bin/composer`
1. Clone the sendgrid-php repo
  - `git clone https://github.com/sendgrid/sendgrid-php.git`
  - `cd sendgrid-php`
  - `composer install`
2. [Install Docker](https://docs.docker.com/install/)
3. [Setup local environment variable SENDGRID_API_KEY](https://github.com/sendgrid/sendgrid-php#setup-environment-variables)
4. Build Docker image, run Docker container, login to the Docker container
  - `cd docker`
  - `docker image build --tag="sendgrid/php7" .`
  - `docker run -itd --name="sendgrid_php7" -v /Users/ethomas/Workspace/sendgrid/sendgrid-php:/root/sendgrid/sendgrid-php sendgrid/php7`
  - `sudo docker exec -it sendgrid_php7 /bin/bash`
5. Try running the tests within the Docker container
  - `cd test/unit`
  - `../../vendor/bin/phpunit . --filter test*`

<a name="testing"></a>
# For Testing the Library (Kick the Tires)

- After step 4 in the QuickStart: `php sendmail.php` within the Docker container.

<a name="contributing"></a>
# For Contributors

- Develop per usual locally, but before pushing up to GitHub, you can run the tests locally in the Docker container per step 5 of the quickstart.
