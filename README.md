[![BuildStatus](https://travis-ci.org/sendgrid/sendgrid-php.svg?branch=v3beta)](https://travis-ci.org/sendgrid/sendgrid-php)

**This library allows you to quickly and easily use the SendGrid Web API via PHP.**

# Announcements

**NOTE: The `/mail/send/beta` endpoint is currently in beta!

Since this is not a general release, we do not recommend POSTing production level traffic through this endpoint or integrating your production servers with this endpoint.

When this endpoint is ready for general release, your code will require an update in order to use the official URI.

By using this endpoint, you accept that you may encounter bugs and that the endpoint may be taken down for maintenance at any time. We cannot guarantee the continued availability of this beta endpoint. We hope that you like this new endpoint and we appreciate any [feedback](dx+mail-beta@sendgrid.com) that you can send our way.**

**BREAKING CHANGE as of XXXX.XX.XX**

Version `5.0.0` is a breaking change for the entire library.

Version 5.0.0 brings you full support for all Web API v3 endpoints. We
have the following resources to get you started quickly:

-   [SendGrid
    Documentation](https://sendgrid.com/docs/API_Reference/Web_API_v3/index.html)
-   [Usage
    Documentation](https://github.com/sendgrid/sendgrid-php/tree/v3beta/USAGE.md)
-   [Example
    Code](https://github.com/sendgrid/sendgrid-php/tree/v3beta/examples)

All updates to this library is documented in our [CHANGELOG](https://github.com/sendgrid/sendgrid-php/blob/v3beta/CHANGELOG.md).

# Installation

## Environment Variables

First, get your free SendGrid account [here](https://sendgrid.com/free?source=sendgrid-php).

Next, update your environment with your [SENDGRID_API_KEY](https://app.sendgrid.com/settings/api_keys).

```bash
echo "export SENDGRID_API_KEY='YOUR_API_KEY'" > sendgrid.env
echo "sendgrid.env" >> .gitignore
source ./sendgrid.env
```

## TRYING OUT THE V3 BETA MAIL SEND

```bash
git clone -b v3beta --single-branch https://github.com/sendgrid/sendgrid-php.git
cd sendgrid-php
composer install
```

* Update the to and from [emails](https://github.com/sendgrid/sendgrid-php/blob/v3beta/examples/helpers/mail/example.php#L11).

```bash
php examples/helpers/mail/example.php
```

* Check out the documentation for [Web API v3 /mail/send/beta endpoint](https://sendgrid.com/docs/API_Reference/Web_API_v3/Mail/index.html).

## TRYING OUT THE V3 BETA WEB API

```bash
git clone -b v3beta --single-branch https://github.com/sendgrid/sendgrid-php.git
```

* Check out the documentation for [Web API v3 endpoints](https://sendgrid.com/docs/API_Reference/Web_API_v3/index.html).
* Review the corresponding [examples](https://github.com/sendgrid/sendgrid-php/blob/v3beta/examples).
* From the root directory of this repo, replace `require 'vendor/autoload.php';` with:
```php
require './vendor/autoload.php';
require './lib/SendGrid.php';
```

## Once we are out of v3 BETA, the following will apply

Add SendGrid to your `composer.json` file. If you are not using [Composer](http://getcomposer.org), you should be. It's an excellent way to manage dependencies in your PHP application.

```json
{
  "require": {
    "sendgrid/sendgrid": "~5.0"
  }
}
```

Then at the top of your PHP script require the autoloader:

```bash
require 'vendor/autoload.php';
```

#### Alternative: Install from zip

If you are not using Composer, simply download and install the **[latest packaged release of the library as a zip](https://sendgrid-open-source.s3.amazonaws.com/sendgrid-php/sendgrid-php.zip)**.

[**⬇︎ Download Packaged Library ⬇︎**](https://sendgrid-open-source.s3.amazonaws.com/sendgrid-php/sendgrid-php.zip)

Then require the library from package:

```php
require("path/to/sendgrid-php/sendgrid-php.php");
```

Previous versions of the library can be found in the [version index](https://sendgrid-open-source.s3.amazonaws.com/index.html).

## Dependencies

- The SendGrid Service, starting at the [free level](https://sendgrid.com/free?source=sendgrid-php)
- [php-HTTP-Client](https://github.com/sendgrid/php-http-client)

# Quick Start

## Hello Email

```php
// If you are using Composer
require 'vendor/autoload.php';

$from = new Email(null, "test@example.com");
$subject = "Hello World from the SendGrid PHP Library";
$to = new Email(null, "test@example.com");
$content = new Content("text/plain", "some text here");
$mail = new Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->beta()->post($mail);
echo $response->statusCode();
echo $response->headers();
echo $response->body();
```

## General v3 Web API Usage

```php
// If you are using Composer
require 'vendor/autoload.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->api_keys()->get();

print $response->statusCode();
print $response->headers();
print $response->body();
```

# Usage

- [SendGrid Docs](https://sendgrid.com/docs/API_Reference/index.html)
- [Usage
    Documentation](https://github.com/sendgrid/sendgrid-php/tree/v3beta/USAGE.md)
- [Example Code](https://github.com/sendgrid/sendgrid-php/tree/v3beta/examples)
- [v3 Web API Mail Send Helper](https://github.com/sendgrid/sendgrid-php/tree/v3beta/lib/helpers/mail/README.md) - build a request object payload for a v3 /mail/send API call.

## Roadmap

If you are intersted in the future direction of this project, please take a look at our [milestones](https://github.com/sendgrid/sendgrid-php/milestones). We would love to hear your feedback.

## How to Contribute

We encourage contribution to our libraries, please see our [CONTRIBUTING](https://github.com/sendgrid/sendgrid-php/blob/v3beta/CONTRIBUTING.md) guide for details.

Quick links:

- [Feature Request](https://github.com/sendgrid/sendgrid-php/blob/v3beta/CONTRIBUTING.md#feature_request)
- [Bug Reports](https://github.com/sendgrid/sendgrid-php/blob/v3beta/CONTRIBUTING.md#submit_a_bug_report)
- [Sign the CLA to Create a Pull Request](https://github.com/sendgrid/sendgrid-php/blob/v3beta/CONTRIBUTING.md#cla)
- [Improvements to the Codebase](https://github.com/sendgrid/sendgrid-php/blob/v3beta/CONTRIBUTING.md#improvements_to_the_codebase)

# About

sendgrid-php is guided and supported by the SendGrid [Developer Experience Team](mailto:dx@sendgrid.com).

sendgrid-php is maintained and funded by SendGrid, Inc. The names and logos for sendgrid-php are trademarks of SendGrid, Inc.

![SendGrid Logo]
(https://uiux.s3.amazonaws.com/2016-logos/email-logo%402x.png)

