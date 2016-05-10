[![BuildStatus](https://travis-ci.org/sendgrid/sendgrid-php.svg?branch=master)](https://travis-ci.org/sendgrid/sendgrid-php)
[![Latest Stable Version](https://poser.pugx.org/sendgrid/sendgrid/version.svg)](https://packagist.org/packages/sendgrid/sendgrid)

**This library allows you to quickly and easily use the SendGrid Web API via PHP.**

**NOTE: The `/mail/send/beta` endpoint is currently in beta!

Since this is not a general release, we do not recommend POSTing production level traffic through this endpoint or integrating your production servers with this endpoint.

When this endpoint is ready for general release, your code will require an update in order to use the official URI.

By using this endpoint, you accept that you may encounter bugs and that the endpoint may be taken down for maintenance at any time. We cannot guarantee the continued availability of this beta endpoint. We hope that you like this new endpoint and we appreciate any [feedback](dx+mail-beta@sendgrid.com) that you can send our way.**

# Installation

Add SendGrid to your `composer.json` file. If you are not using [Composer](http://getcomposer.org), you should be. It's an excellent way to manage dependencies in your PHP application.

```json
{
  "require": {
    "sendgrid/sendgrid": "~4.0"
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

- [php-HTTP-Client](https://github.com/sendgrid/php-http-client)

## Environment Variables

First, get your free SendGrid account [here](https://sendgrid.com/free?source=sendgrid-php).

Next, update your environment with your [SENDGRID_API_KEY](https://app.sendgrid.com/settings/api_keys).

```bash
echo "export SENDGRID_API_KEY='YOUR_API_KEY'" > sendgrid.env
echo "sendgrid.env" >> .gitignore
source ./sendgrid.env
```

# Quick Start

## Hello Email

```php
namespace SendGrid;

require dirname(__DIR__).'/vendor/autoload.php';
require dirname(__DIR__).'/lib/SendGrid.php';
require dirname(__DIR__).'/lib/helpers/mail/Mail.php';

$from = new Email(null, "dx@sendgrid.com");
$subject = "Hello World from the SendGrid PHP Library";
$to = new Email(null, "elmer.thomas@sendgrid.com");
$content = new Content("text/plain", "some text here");
$mail = new Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->beta()->post($mail);
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();
```

## General v3 Web API Usage

```php
namespace SendGrid;

require dirname(__DIR__).'/vendor/autoload.php';
require dirname(__DIR__).'/lib/SendGrid.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey, array('host' => 'https://api.sendgrid.com'));

$response = $sg->client->api_keys()->get(null, $query_params, $request_headers);

print $response->statusCode();
print $response->responseHeaders();
print $response->responseBody();
```

# Announcements

**BREAKING CHANGE as of XXXX.XX.XX**

Version `5.0.0` is a breaking change for the entire library.

Version 5.0.0 brings you full support for all Web API v3 endpoints. We
have the following resources to get you started quickly:

-   [SendGrid
    Documentation](https://sendgrid.com/docs/API_Reference/Web_API_v3/index.html)
-   [Usage
    Documentation](https://github.com/sendgrid/sendgrid-php/blob/master/USAGE.md)
-   [Example
    Code](https://github.com/sendgrid/sendgrid-php/blob/master/examples)

Thank you for your continued support!

## Roadmap

[Milestones](https://github.com/sendgrid/sendgrid-php/milestones)

## How to Contribute

We encourage contribution to our libraries, please see our [CONTRIBUTING](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md) guide for details.

* [Feature Request](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md#feature_request)
* [Bug Reports](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md#submit_a_bug_report)
* [Improvements to the Codebase](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md#improvements_to_the_codebase)

## Usage

- [SendGrid Docs](https://sendgrid.com/docs/API_Reference/index.html)
- [v3 Web API](https://github.com/sendgrid/sendgrid-php/blob/master/USAGE.md)
- [Example Code](https://github.com/sendgrid/sendgrid-php/blob/master/examples)
- [v3 Web API Mail Send Helper]()

## Unsupported Libraries

- [Official and Unsupported SendGrid Libraries](https://sendgrid.com/docs/Integrate/libraries.html)

# About

![SendGrid Logo]
(https://assets3.sendgrid.com/mkt/assets/logos_brands/small/sglogo_2015_blue-9c87423c2ff2ff393ebce1ab3bd018a4.png)

sendgrid-php is guided and supported by the SendGrid [Developer Experience Team](mailto:dx@sendgrid.com).

sendgrid-php is maintained and funded by SendGrid, Inc. The names and logos for sendgrid-php are trademarks of SendGrid, Inc.