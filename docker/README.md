Use Docker to easily try out or contribute to the sendgrid-php library. 

This Docker image contains:
 - PHP 7.1.16
 - A running instance of [Stoplight.io's Prism](https://stoplight.io/platform/prism/), which lets you try out the Twilio SendGrid API without actually sending email
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
  - `docker image build --tag="sendgrid/php7" ./docker`
  - `docker run -itd --name="sendgrid_php7" -v $(pwd):/root/sendgrid-php sendgrid/php7 /bin/bash`
5. Run the tests within the Docker container
  - `docker exec -it sendgrid_php7 /bin/bash -c 'cd sendgrid-php/test; ../vendor/bin/phpunit . --filter test*; exec "${SHELL:-sh}"'`

Now you can continue development locally, and run `../vendor/bin/phpunit . --filter test*` inside of the container to test. Replace `test*` with the name of a particular test if you do not wish to run the entire suite of tests.

To clean up the container: `docker stop sendgrid_php7 && docker rm sendgrid_php7`.

Happy Hacking! 

<a name="testing"></a>
# For Testing the Library (Kick the Tires)

- After step 5 in the QuickStart, within the Docker container: 
  - `cd ../`
  - `php sendmail.php` 

<a name="contributing"></a>
# For Contributors

- Develop per usual locally, but before pushing up to GitHub, you can run the tests locally in the Docker container per step 5 of the quickstart.
- To run all the tests: `../vendor/bin/phpunit . --filter test*`
- To run an individual test: `../vendor/bin/phpunit . --filter [Name of Test]`
