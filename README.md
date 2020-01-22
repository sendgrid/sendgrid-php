![SendGrid Logo](https://github.com/sendgrid/sendgrid-python/raw/master/twilio_sendgrid_logo.png)

[![BuildStatus](https://travis-ci.org/sendgrid/sendgrid-php.svg?branch=master)](https://travis-ci.org/sendgrid/sendgrid-php)
[![Packagist](https://img.shields.io/packagist/v/sendgrid/sendgrid.svg)](https://packagist.org/packages/sendgrid/sendgrid)
[![Downloads](https://img.shields.io/packagist/dt/sendgrid/sendgrid.svg?maxAge=3600)](https://packagist.org/packages/sendgrid/sendgrid)
[![Email Notifications Badge](https://dx.sendgrid.com/badge/php)](https://dx.sendgrid.com/newsletter/php)
[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](./LICENSE.md)
[![Twitter Follow](https://img.shields.io/twitter/follow/sendgrid.svg?style=social&label=Follow)](https://twitter.com/sendgrid)
[![GitHub contributors](https://img.shields.io/github/contributors/sendgrid/sendgrid-php.svg)](https://github.com/sendgrid/sendgrid-php/graphs/contributors)
[![Open Source Helpers](https://www.codetriage.com/sendgrid/sendgrid-php/badges/users.svg)](https://www.codetriage.com/sendgrid/sendgrid-php)

**NEW:**
- Subscribe to email [notifications](https://dx.sendgrid.com/newsletter/php) for releases and breaking changes.
- Send SMS messages with [Twilio](https://github.com/sendgrid/sendgrid-php/blob/master/USE_CASES.md#sms).

**This library allows you to quickly and easily use the Twilio SendGrid Web API v3 via PHP.**

Version 7.X.X of this library provides full support for all Twilio SendGrid [Web API v3](https://sendgrid.com/docs/API_Reference/Web_API_v3/index.html) endpoints, including the new [v3 /mail/send](https://sendgrid.com/blog/introducing-v3mailsend-sendgrids-new-mail-endpoint).

We want this library to be community driven and Twilio SendGrid led. Your help is needed to realize this goal. To help make sure we are building the right things in the right order, we ask that you create [issues](https://github.com/sendgrid/sendgrid-php/issues) and [pull requests](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md) or simply upvote or comment on existing issues or pull requests.

Please browse the rest of this README for further details.

We appreciate your continued support, thank you!

# Table of Contents

* [Installation](#installation)
* [Quick Start](#quick-start)
* [Use Cases](#use-cases)
* [Usage](#usage)
* [Announcements](#announcements)
* [Roadmap](#roadmap)
* [How to Contribute](#contribute)
* [Troubleshooting](#troubleshooting)
* [About](#about)
* [License](#license)

<a name="installation"></a>
# Installation

## Prerequisites

- PHP version 5.6, 7.0, 7.1, 7.2, or 7.3
- The Twilio SendGrid service, starting at the [free level](https://sendgrid.com/free?source=sendgrid-php) to send up to 40,000 emails for the first 30 days, then send 100 emails/day free forever or check out [our pricing](https://sendgrid.com/pricing?source=sendgrid-php).
- For SMS messages, you will need a free [Twilio account](https://www.twilio.com/try-twilio?source=sendgrid-php).

## Setup Environment Variables

Update the development environment with your [SENDGRID_API_KEY](https://app.sendgrid.com/settings/api_keys), for example:

1. Copy the sample env file to a new file named `.env`
```bash
cp .env.sample .env
```
2. Edit the `.env` file to include your `SENDGRID_API_KEY`
3. Source the `.env` file
```bash
source ./.env
```

## Install Package

Add Twilio SendGrid to your `composer.json` file. If you are not using [Composer](http://getcomposer.org), we highly recommend it. It's an excellent way to manage dependencies in your PHP application.

```json
{
  "require": {
    "sendgrid/sendgrid": "~7"
  }
}
```

#### Alternative: Install package from zip

If you are not using Composer, simply download and install the **[latest packaged release of the library as a zip](https://github.com/sendgrid/sendgrid-php/releases/download/7.4.2/sendgrid-php.zip)**.

[**⬇︎ Download Packaged Library ⬇︎**](https://github.com/sendgrid/sendgrid-php/releases/download/7.4.2/sendgrid-php.zip)

Previous versions of the library can be found in the [version index](https://sendgrid-open-source.s3.amazonaws.com/index.html) or downloaded directly from [GitHub](https://github.com/sendgrid/sendgrid-php/releases).

## Dependencies

- The Twilio SendGrid Service, starting at the [free level](https://sendgrid.com/free?source=sendgrid-php)
- The dependency free [php-http-client](https://github.com/sendgrid/php-http-client)

<a name="quick-start"></a>
# Quick Start

## Hello Email

The following is the minimum needed code to send an email. You may find more examples in our USE_CASES file:

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail();
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
$email->addTo("test@example.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
```

The `SendGrid\Mail` constructor creates a [personalization object](https://sendgrid.com/docs/Classroom/Send/v3_Mail_Send/personalizations.html) for you. [Here](https://github.com/sendgrid/sendgrid-php/blob/master/USE_CASES.md#kitchen-sink) is an example of how to add to it.

## General v3 Web API Usage (With Fluent Interface)

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

try {
    $response = $sg->client->suppression()->bounces()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

## General v3 Web API Usage (Without Fluent Interface)

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

try {
    $response = $sg->client->_("suppression/bounces")->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

<a name="use-cases"></a>
# Use Cases

[Examples of common API use cases](https://github.com/sendgrid/sendgrid-php/blob/master/USE_CASES.md), such as how to send an email with a transactional template.

<a name="usage"></a>
# Usage

- [Twilio SendGrid Docs](https://sendgrid.com/docs/API_Reference/index.html)
- [Generic Library Usage
    Documentation](https://github.com/sendgrid/sendgrid-php/tree/master/USAGE.md)
- [Example Code](https://github.com/sendgrid/sendgrid-php/blob/master/USE_CASES.md)

<a name="announcements"></a>
# Announcements

v7 has been released! Please see the [release notes](https://github.com/sendgrid/sendgrid-php/releases/tag/v7.0.0) for details.

All updates to this library are documented in our [CHANGELOG](https://github.com/sendgrid/sendgrid-php/blob/master/CHANGELOG.md) and [releases](https://github.com/sendgrid/sendgrid-php/releases). You may also subscribe to email [release notifications](https://dx.sendgrid.com/newsletter/php) for releases and breaking changes.

<a name="roadmap"></a>
# Roadmap

If you are interested in the future direction of this project, please take a look at our open [issues](https://github.com/sendgrid/sendgrid-php/issues) and [pull requests](https://github.com/sendgrid/sendgrid-php/pulls). We would love to hear your feedback.

<a name="contribute"></a>
# How to Contribute

We encourage contribution to our libraries (you might even score some nifty swag), please see our [CONTRIBUTING](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md) guide for details.

Quick links:

- [Feature Request](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md#feature_request)
- [Bug Reports](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md#submit_a_bug_report)
- [Sign the CLA to Create a Pull Request](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md#cla)
- [Improvements to the Codebase](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md#improvements_to_the_codebase)
- [Review Pull Requests](https://github.com/sendgrid/sendgrid-php/blob/master/CONTRIBUTING.md#code-reviews)

<a name="troubleshooting"></a>
# Troubleshooting

Please see our [troubleshooting guide](https://github.com/sendgrid/sendgrid-php/blob/master/TROUBLESHOOTING.md) for common library issues.

<a name="about"></a>
# About

sendgrid-php is guided and supported by the Twilio [Developer Experience Team](mailto:dx@sendgrid.com).

sendgrid-php is maintained and funded by Twilio SendGrid, Inc. The names and logos for sendgrid-php are trademarks of Twilio SendGrid, Inc.


# License
[The MIT License (MIT)](LICENSE.md)
