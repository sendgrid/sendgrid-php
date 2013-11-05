# Sendgrid-php

This library allows you to quickly and easily send emails through SendGrid using PHP.

Important: This library requires PHP 5.3 or higher.

[![BuildStatus](https://travis-ci.org/sendgrid/sendgrid-php.png?branch=master)](https://travis-ci.org/sendgrid/sendgrid-php)
[![Latest Stable Version](https://poser.pugx.org/sendgrid/sendgrid/version.png)](https://packagist.org/packages/sendgrid/sendgrid)

```php
$sendgrid = new SendGrid('username', 'password');
$email    = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       addTo('dude@bar.com')->
       setFrom('me@bar.com')->
       setSubject('Subject goes here')->
       setText('Hello World!')->
       setHtml('<strong>Hello World!</strong>');

$sendgrid->web->send($email);
```


## Installation

### Install with Composer 
If you are using [Composer](http://getcomposer.org) to manage dependencies, you can add SendGrid with it.

```json
{  
  "minimum-stability" : "dev",
  "require": {
    "sendgrid/sendgrid": "1.1.5"
  }
}
```

Then at the top of your script register the autoloader:

```bash
require 'vendor/autoload.php';
SendGrid::register_autoloader();
```

### Install source from GitHub

To install the source code:

```bash
git clone https://github.com/Mashape/unirest-php.git 
git clone https://github.com/sendgrid/sendgrid-php.git
```

And include it in your scripts:

```bash
require_once '/path/to/unirest-php/lib/Unirest.php';
require_once '/path/to/sendgrid-php/lib/SendGrid.php';
```

You'll probably also want to register an autoloader:

```bash
SendGrid::register_autoloader();
```

#### Optional

IF using the `smtp` option, you need [swiftmailer](https://github.com/swiftmailer/swiftmailer). This is not necessary if using the web API approach. 

```bash
git clone git://github.com/swiftmailer/swiftmailer.git
ln -s swiftmailer/lib/swift_required.php swift_required.php
```

## SendGrid APIs ##

SendGrid provides two methods of sending email: the Web API, and SMTP API.  SendGrid recommends using the SMTP API for sending emails.
For an explanation of the benefits of each, refer to http://docs.sendgrid.com/documentation/get-started/integrate/examples/smtp-vs-rest/.

This library implements a common interface to make it very easy to use either API.

## Example App

There is a [sendgrid-php-example app](https://github.com/scottmotte/sendgrid-php-example) to help jumpstart your development.

## Usage

To begin using this library, initialize the SendGrid object with your SendGrid credentials.

```php
$sendgrid = new SendGrid('username', 'password');
```

Create a new SendGrid Email object and add your message details.

```php
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       setFrom('me@bar.com')->
       setSubject('Subject goes here')->
       setText('Hello World!')->
       setHtml('<strong>Hello World!</strong>');
```

Send it using the API of your choice (Web or SMTP)

```php
$sendgrid->web->send($mail);
```
Or 

```php
$sendgrid->smtp->send($mail);
```

### addTo

You can add one or multiple TO addresses using `addTo`.

```php
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       addTo('another@another.com');
$sendgrid->web->send($mail);
```

### setTos

If you prefer, you can add multiple TO addresses as an array using the `setTos` method. This will unset any previous `addTo`s you appended.

```php
$mail   = new SendGrid\Email();
$emails = array("foo@bar.com", "another@another.com", "other@other.com");
$mail->setTos($emails);
$sendgrid->web->send($mail);
```

### getTos

Sometimes you might find yourself wanting to list the currently set Tos. You can do that with `getTos`.

```php
$mail   = new SendGrid\Email();
$mail->addTo('foo@bar.com');
$mail->getTos();
```

### removeTo 

You might also find yourself wanting to remove a single TO from your set list of TOs. You can do that with `removeTo`. You can pass a string or regex to the removeTo method.

```php
$mail   = new SendGrid\Email();
$mail->addTo('foo@bar.com');
$mail->removeTo('foo@bar.com');
```

### setFrom

```php
$mail   = new SendGrid\Email();
$mail->setFrom('foo@bar.com');
$sendgrid->web->send($mail);
```

### setFromName

```php
$mail   = new SendGrid\Email();
$mail->setFrom('foo@bar.com');
$mail->setFromName('Foo Bar');
$mail->setFrom('other@example.com');
$mail->setFromName('Other Guy');
$sendgrid->web->send($mail);
```

### setReplyTo

```php
$mail   = new SendGrid\Email();
$mail->setReplyTo('foo@bar.com');
$sendgrid->web->send($mail);
```

### addCc

```php
$mail   = new SendGrid\Email();
$mail->addCc('foo@bar.com');
$sendgrid->web->send($mail);
```

### Bcc

Use multiple `addTo`s as a superior alternative to `setBcc`.

```php
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       addTo('someotheraddress@bar.com')->
       addTo('another@another.com')->
       ...
```

But if you do still have a need for Bcc you can do the following.

```php
$mail   = new SendGrid\Email();
$mail->addBcc('foo@bar.com');
$sendgrid->web->send($mail);
```

### setSubject

```php
$mail   = new SendGrid\Email();
$mail->setSubject('This is a subject');
$sendgrid->web->send($mail);
```

### setText

```php
$mail   = new SendGrid\Email();
$mail->setText('This is some text');
$sendgrid->web->send($mail);
```

### setHtml

```php
$mail   = new SendGrid\Email();
$mail->setHtml('<h1>This is an html email</h1>');
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
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       ...
       addCategory("Category 1")->
       addCategory("Category 2");
```

### Attachments ###

Attachments are currently file based only, with future plans for an in memory implementation as well.

File attachments are limited to 7 MB per file.

```php
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       ...
       addAttachment("../path/to/file.txt");    
```

**Important Gotcha**: `setBcc` is not supported with attachments. This is by design. Instead use multiple `addTo`s. Each user will receive their own personalized email with that setup, and only see their own email.


Standard `setBcc` will hide who the email is addressed to. If you use the multiple addTo, each user will receive a personalized email showing **only* their email. This is more friendly and more personal. Additionally, it is a good idea to use multiple `addTo`s because setBcc is not supported with attachments. This is by design.

So just remember, when thinking 'bcc', instead use multiple `addTo`s.

### From-Name and Reply-To

There are two handy helper methods for setting the From-Name and Reply-To for a
message

```php
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       setReplyTo('someone.else@example.com')->
       setFromName('John Doe')->
       ...
```

### Substitutions ###

Substitutions can be used to customize multi-recipient emails, and tailor them for the user

```php
$mail = new SendGrid\Email();
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
$mail = new SendGrid\Email();
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
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       ...
       addUniqueArgument("Customer", "Someone")->
       addUniqueArgument("location", "Somewhere");
```

### Filter Settings ###

Filter Settings are used to enable and disable apps, and to pass parameters to those apps.

```php
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       ...
       addFilterSetting("gravatar", "enable", 1)->
       addFilterSetting("footer", "enable", 1)->
       addFilterSetting("footer", "text/plain", "Here is a plain text footer")->
       addFilterSetting("footer", "text/html", "<p style='color:red;'>Here is an HTML footer</p>");
```

### Smtp API Headers ###

Smtp API Headers can be used to add existing sendgrid functionality (such as for categories or filters), or custom headers can be added as necessary.

```php
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       ...
       addSmtpapiHeader("category", "My New Category");
```

### Message Headers ###

You can add standard email message headers as necessary.

```php
$mail = new SendGrid\Email();
$mail->addTo('foo@bar.com')->
       ...
       addMessageHeader('X-Sent-Using', 'SendGrid-API')->
       addMessageHeader('X-Transport', 'web');
```

### Sending to 1,000s of emails in one batch

Sometimes you might want to send 1,000s of emails in one request. You can do that. It is recommended you break each batch up in 1,000 increements. So if you need to send to 5,000 emails, then you'd break this into a loop of 1,000 emails at a time.

```php
$sendgrid   = new SendGrid(SENDGRID_USERNAME, SENDGRID_PASSWORD);
$mail       = new SendGrid\Email();

$recipients = array("alpha@mailinator.com", "beta@mailinator.com", "zeta@mailinator.com");
$names      = array("Alpha", "Beta", "Zeta");

$mail-> setFrom("from@mailinator.com")->
        setSubject('[sendgrid-php-batch-email]')->
        setTos($recipients)->
        addSubstitution("%name%", $names)->
        setText("Hey %name, we have an email for you")->
        setHtml("<h1>Hey %name%, we have an email for you</h1>");

$result = $sendgrid->smtp->send($mail);
```

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Added some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

## Running Tests ##

The existing tests in the `test` directory can be run using [PHPUnit](https://github.com/sebastianbergmann/phpunit/) with the following command:

````bash
composer update --dev
cd test
../vendor/bin/phpunit test/
```

or if you already have PHPUnit installed globally.

```bash
cd test
phpunit
```

## Known Issues

* When using the smtp version (which is built on top of swiftmailer), any FROM names with parentheses will have the content of the parentheses stripped out. If this happens please use the web version of the library. Read more about this in [issue #27](https://github.com/sendgrid/sendgrid-php/issues/27).
