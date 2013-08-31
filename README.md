# Sendgrid-php

This library allows you to quickly and easily send emails through SendGrid using PHP.

[![BuildStatus](https://travis-ci.org/sendgrid/sendgrid-php.png?branch=master)](https://travis-ci.org/sendgrid/sendgrid-php)

```php
$sendgrid = new SendGrid('username', 'password');
$mail     = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       addTo('dude@bar.com')->
       setFrom('me@bar.com')->
       setSubject('Subject goes here')->
       setText('Hello World!')->
       setHtml('<strong>Hello World!</strong>');

$sendgrid->smtp->send($mail);
```

## Installation

The following recommended installation requires [composer](http://getcomposer.org/). If you are unfamiliar with composer see the [composer installation instructions](http://getcomposer.org/doc/01-basic-usage.md#installation).

Add the following to your `composer.json` file:

```json
{  
  "require": {
    "sendgrid/sendgrid": "~1.0.0"
  }
}
```

Install sendgrid-php and its dependencies:

```bash
composer install
```

Load sendgrid-php and its dependencies into your project:

```php
require 'vendor/autoload.php';
```

### Alternative Installation

If you choose not to use composer you can do the following alternative installation using git:

```bash
git clone https://github.com/sendgrid/sendgrid-php.git
```

Then require the autoloader from your php script:

```php
require '../path/to/sendgrid-php/SendGrid_loader.php';
```

Finally, install SwiftMailer using pear.

```bash
pear channel-discover pear.swiftmailer.org
pear install swift/swift
```

*Note: If you do not plan on sending using SMTP, you can skip installation of swiftmailer.*

## SendGrid APIs ##

SendGrid provides two methods of sending email: the Web API, and SMTP API.  SendGrid recommends using the SMTP API for sending emails.
For an explanation of the benefits of each, refer to http://docs.sendgrid.com/documentation/get-started/integrate/examples/smtp-vs-rest/.

This library implements a common interface to make it very easy to use either API.

## Pre-Usage ##

Before we begin using the library, its important to understand a few things about the library architecture...

* The SendGrid Mail object is the means of setting mail data. In general, data can be set in three ways for most elements:
  1. set - reset the data, and initialize it to the given element. This will destroy previous data
  2. set (List) - for array based elements, we provide a way of passing the entire array in at once. This will also destroy previous data.
  3. add - append data to the list of elements.

* Sending an email is as simple as :
  1. Creating a SendGrid Instance
  1. Creating a SendGrid Mail object, and setting its data
  1. Sending the mail using either SMTP API or Web API.

## Usage

To begin using this library, initialize the SendGrid object with your SendGrid credentials.

```php
$sendgrid = new SendGrid('username', 'password');
```

Create a new SendGrid Mail object and add your message details.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       setFrom('me@bar.com')->
       setSubject('Subject goes here')->
       setText('Hello World!')->
       setHtml('<strong>Hello World!</strong>');
```

Send it using the API of your choice (SMTP or Web)

```php
$sendgrid->smtp->send($mail);
```
Or 

```php
$sendgrid->web->send($mail);
```

### Port and Hostname ###

For the smtp API you can optionally choose to set the Port and the Hostname.

```php
$sendgrid->smtp->setPort('1234567');
$sendgrid->smtp->setHostname('smtp.dude.com');
```

This is useful if you are using a local relay, as documented in [here](http://sendgrid.com/docs/Integrate/#--Power-Users-and-High-Volume-Senders).

### Categories ###

Categories are used to group email statistics provided by SendGrid.

To use a category, simply set the category name.  Note: there is a maximum of 10 categories per email.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addCategory("Category 1")->
       addCategory("Category 2");
```

### Attachments ###

Attachments are currently file based only, with future plans for an in memory implementation as well.

File attachments are limited to 7 MB per file.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addAttachment("../path/to/file.txt");    
```

**Important Gotcha**: `setBcc` is not supported with attachments. This is by design. Instead use multiple `addTo`s. Each user will receive their own personalized email with that setup, and only see their own email.

### Bcc

Use multiple `addTo`s as a superior alternative to `setBcc`.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       addTo('someotheraddress@bar.com')->
       addTo('another@another.com')->
       ...
```

Standard `setBcc` will hide who the email is addressed to. If you use the multiple addTo, each user will receive a personalized email showing **only* their email. This is more friendly and more personal. Additionally, it is a good idea to use multiple `addTo`s because setBcc is not supported with attachments. This is by design.

So just remember, when thinking 'bcc', instead use multiple `addTo`s.

### From-Name and Reply-To

There are two handy helper methods for setting the From-Name and Reply-To for a
message

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       setReplyTo('someone.else@example.com')->
       setFromName('John Doe')->
       ...
```

### Substitutions ###

Substitutions can be used to customize multi-recipient emails, and tailor them for the user

```php
$mail = new SendGrid\Mail();
$mail->addTo('john@somewhere.com')->
       addTo("harry@somewhere.com")->
       addTo("Bob@somewhere.com")->
       ...
       setHtml("Hey %name%, we've seen that you've been gone for a while")->
       addSubstitution("%name%", array("John", "Harry", "Bob"));
```

### Sections ###

Sections can be used to further customize messages for the end users. A section is only useful in conjunction with a substition value.

```php
$mail = new SendGrid\Mail();
$mail->addTo('john@somewhere.com')->
       addTo("harry@somewhere.com")->
       addTo("Bob@somewhere.com")->
       ...
       setHtml("Hey %name%, you work at %place%")->
       addSubstitution("%name%", array("John", "Harry", "Bob"))->
       addSubstitution("%place%", array("%office%", "%office%", "%home%"))->
       addSection("%office%", "an office")->
       addSection("%home%", "your house");
```

### Unique Arguments ###

Unique Arguments are used for tracking purposes

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addUniqueArgument("Customer", "Someone")->
       addUniqueArgument("location", "Somewhere");
```

### Filter Settings ###

Filter Settings are used to enable and disable apps, and to pass parameters to those apps.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addFilterSetting("gravatar", "enable", 1)->
       addFilterSetting("footer", "enable", 1)->
       addFilterSetting("footer", "text/plain", "Here is a plain text footer")->
       addFilterSetting("footer", "text/html", "<p style='color:red;'>Here is an HTML footer</p>");
```

### Headers ###

Headers can be used to add existing sendgrid functionality (such as for categories or filters), or custom headers can be added as necessary.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addHeader("category", "My New Category");
```

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Added some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

## Running Tests ##

The existing tests in the `Test` directory can be run using [PHPUnit](https://github.com/sebastianbergmann/phpunit/) with the following command:

````bash
composer update --dev
vendor/bin/phpunit Test/
```

or if you already have PHPUnit installed globally.

```bash
phpunit Test/
```

## Known Issues

* When using the smtp version (which is built on top of swiftmailer), any FROM names with parentheses will have the content of the parentheses stripped out. If this happens please use the web version of the library. Read more about this in [issue #27](https://github.com/sendgrid/sendgrid-php/issues/27).
