# Sendgrid-php

This library allows you to quickly and easily send emails and manage reports through SendGrid using PHP.

WARNING: This module was recently upgraded from [1.1.7](https://github.com/sendgrid/sendgrid-php/tree/v1.1.7) to 2.0.3. There were API breaking changes for various method names. See [usage](https://github.com/sendgrid/sendgrid-php#usage) for up to date method names.

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

$sendgrid->send($email);
```


## Installation

Add SendGrid to your `composer.json` file. If you are not using [Composer](http://getcomposer.org), you should be. It's an excellent way to manage dependencies in your PHP application. 

```json
{  
  "require": {
    "sendgrid/sendgrid": "2.0.5"
  }
}
```

Then at the top of your PHP script require the autoloader:

```bash
require 'vendor/autoload.php';
```

#### Alternative: Install from zip

If you are not using Composer, simply download and install the **[latest packaged release of the library as a zip](https://sendgrid-open-source.s3.amazonaws.com/sendgrid-php/sendgrid-php.zip)**. 

Then require the library from package:

```php
require("path/to/sendgrid-php/sendgrid-php.php");
```

Previous versions of the library can be found in the [version index](https://sendgrid-open-source.s3.amazonaws.com/index.html).

## Example App

There is a [sendgrid-php-example app](https://github.com/sendgrid/sendgrid-php-example) to help jumpstart your development.

## Usage

To begin using this library, initialize the SendGrid object with your SendGrid credentials.

```php
$sendgrid = new SendGrid('username', 'password');
```

Create a new SendGrid Email object and add your message details.

```php
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       setFrom('me@bar.com')->
       setSubject('Subject goes here')->
       setText('Hello World!')->
       setHtml('<strong>Hello World!</strong>');
```

Send it. 

```php
$sendgrid->send($email);
```

For reports, create a new Sendgrid Report object and your method details. 

```php
$report = new SendGrid\Report();
$report->spamreports()->email('foo@bar.com');
$result = $sendgrid->report($report);
```

You can get Spam Reports, Blocks, Bounces, Invalid Emails, and Unsubscribes as defined in the [SendGrid Web API](https://sendgrid.com/docs/API_Reference/Web_API/index.html). Actions and parameters are chainable to the method. The get action is inferred by default.

For example, this GET request has a date parameter.

	https://api.sendgrid.com/api/spamreports.get.json?api_user=your_sendgrid_username&api_key=your_sendgrid_password&date=1

The equivalent would look like this:

```php
$sendgrid = new SendGrid('your_sendgrid_username', 'your_sendgrid_password');
$report = new SendGrid\Report();
$report->spamreports()->date();
$result = $sendgrid->report($report);
```

You can keep linking parameters:

```php
$sendgrid = new SendGrid('your_sendgrid_username', 'your_sendgrid_password');
$report = new SendGrid\Report();
$report->spamreports()->date()->days(1)->startDate('2014-01-01')->email('foo@bar.com');
$result = $sendgrid->report($report);
```


If you want to use another action like `delete`, `add` or `count`, just add it to the chain like this:

```php
$sendgrid = new SendGrid('your_sendgrid_username', 'your_sendgrid_password');
$report = new SendGrid\Report();
$report->blocks()->delete()->email('foo@bar.com');
$result = $sendgrid->report($report);
```



### addTo

You can add one or multiple TO addresses using `addTo`.

```php
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       addTo('another@another.com');
$sendgrid->send($email);
```

### setTos

If you prefer, you can add multiple TO addresses as an array using the `setTos` method. This will unset any previous `addTo`s you appended.

```php
$email   = new SendGrid\Email();
$emails = array("foo@bar.com", "another@another.com", "other@other.com");
$email->setTos($emails);
$sendgrid->send($email);
```

### getTos

Sometimes you might find yourself wanting to list the currently set Tos. You can do that with `getTos`.

```php
$email   = new SendGrid\Email();
$email->addTo('foo@bar.com');
$email->getTos();
```

### removeTo 

You might also find yourself wanting to remove a single TO from your set list of TOs. You can do that with `removeTo`. You can pass a string or regex to the removeTo method.

```php
$email   = new SendGrid\Email();
$email->addTo('foo@bar.com');
$email->removeTo('foo@bar.com');
```

### setFrom

```php
$email   = new SendGrid\Email();
$email->setFrom('foo@bar.com');
$sendgrid->send($email);
```

### setFromName

```php
$email   = new SendGrid\Email();
$email->setFrom('foo@bar.com');
$email->setFromName('Foo Bar');
$email->setFrom('other@example.com');
$email->setFromName('Other Guy');
$sendgrid->send($email);
```

### setReplyTo

```php
$email   = new SendGrid\Email();
$email->setReplyTo('foo@bar.com');
$sendgrid->send($email);
```

### Bcc

Use multiple `addTo`s as a superior alternative to `setBcc`.

```php
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       addTo('someotheraddress@bar.com')->
       addTo('another@another.com')->
       ...
```

But if you do still have a need for Bcc you can do the following.

```php
$email   = new SendGrid\Email();
$email->addBcc('foo@bar.com');
$sendgrid->send($email);
```

### setSubject

```php
$email   = new SendGrid\Email();
$email->setSubject('This is a subject');
$sendgrid->send($email);
```

### setText

```php
$email   = new SendGrid\Email();
$email->setText('This is some text');
$sendgrid->send($email);
```

### setHtml

```php
$email   = new SendGrid\Email();
$email->setHtml('<h1>This is an html email</h1>');
$sendgrid->send($email);
```

### Categories ###

Categories are used to group email statistics provided by SendGrid.

To use a category, simply set the category name.  Note: there is a maximum of 10 categories per email.

```php
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       ...
       addCategory("Category 1")->
       addCategory("Category 2");
```

### Attachments ###

Attachments are currently file based only, with future plans for an in memory implementation as well.

File attachments are limited to 7 MB per file.

```php
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
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
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       setReplyTo('someone.else@example.com')->
       setFromName('John Doe')->
       ...
```

### Substitutions ###

Substitutions can be used to customize multi-recipient emails, and tailor them for the user

```php
$email = new SendGrid\Email();
$email->addTo('john@somewhere.com')->
       addTo("harry@somewhere.com")->
       addTo("Bob@somewhere.com")->
       ...
       setHtml("Hey %name%, we've seen that you've been gone for a while")->
       addSubstitution("%name%", array("John", "Harry", "Bob"));
```

### Sections ###

Sections can be used to further customize messages for the end users. A section is only useful in conjunction with a substition value.

```php
$email = new SendGrid\Email();
$email->addTo('john@somewhere.com')->
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
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       ...
       addUniqueArg("Customer", "Someone")->
       addUniqueArg("location", "Somewhere")->
       setUniqueArgs(array('cow' => 'chicken'));
```

### Filter Settings ###

Filter Settings are used to enable and disable apps, and to pass parameters to those apps.

```php
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       ...
       addFilter("gravatar", "enable", 1)->
       addFilter("footer", "enable", 1)->
       addFilter("footer", "text/plain", "Here is a plain text footer")->
       addFilter("footer", "text/html", "<p style='color:red;'>Here is an HTML footer</p>");
```

### Headers ###

You can add standard email message headers as necessary.

```php
$email = new SendGrid\Email();
$email->addTo('foo@bar.com')->
       ...
       addHeader('X-Sent-Using', 'SendGrid-API')->
       addHeader('X-Transport', 'web');
```

### Sending to 1,000s of emails in one batch

Sometimes you might want to send 1,000s of emails in one request. You can do that. It is recommended you break each batch up in 1,000 increements. So if you need to send to 5,000 emails, then you'd break this into a loop of 1,000 emails at a time.

```php
$sendgrid   = new SendGrid(SENDGRID_USERNAME, SENDGRID_PASSWORD);
$email       = new SendGrid\Email();

$recipients = array("alpha@mailinator.com", "beta@mailinator.com", "zeta@mailinator.com");
$names      = array("Alpha", "Beta", "Zeta");

$email->setFrom("from@mailinator.com")->
        setSubject('[sendgrid-php-batch-email]')->
        setTos($recipients)->
        addSubstitution("%name%", $names)->
        setText("Hey %name, we have an email for you")->
        setHtml("<h1>Hey %name%, we have an email for you</h1>");

$result = $sendgrid->send($email);
```

### Ignoring SSL certificate verification

You can optionally ignore verification of SSL certificate when using the Web API.

```php
$options = array("turn_off_ssl_verification" => true);
$sendgrid   = new SendGrid(SENDGRID_USERNAME, SENDGRID_PASSWORD, $options);

$email      = new SendGrid\Email();
...
$result     = $sendgrid->send($email);
```

### Blocks

Returns list of blocks with the status, reason and email

```php
$report = new SendGrid\Report();
$report->blocks();
$result = $sendgrid->report($report);
```


### Bounces

Returns list of bounces with status, reason and email.

```php
$report = new SendGrid\Report();
$report->bounces();
$result = $sendgrid->report($report);
```

With parameter, an optional email address to search for.

```php
$report = new SendGrid\Report();
$report->bounces()->email('foo@bar.com');
$result = $sendgrid->report($report);
```


### Invalid Emails

Returns list of invalid emails with the reason and email.

```php
$report = new SendGrid\Report();
$report->invalidemails();
$result = $sendgrid->report($report);
```
### Spam Reports

Returns list of spam reports with the ip and email.

```php
$report = new SendGrid\Report();
$report->spamreports();
$result = $sendgrid->report($report);
```

### Unsubscribes

Requires API access for unsubscribes.

```php
$report = new SendGrid\Report();
$report->unsubscribes();
$result = $sendgrid->report($report);
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
../vendor/bin/phpunit
```

or if you already have PHPUnit installed globally.

```bash
cd test
phpunit
```

#### Testing uploading to Amazon S3

If you want to test uploading the zipped file to Amazon S3 (SendGrid employees only), do the following.

```
export S3_SIGNATURE="secret_signature"
export S3_POLICY="secret_policy"
export S3_BUCKET="sendgrid-open-source"
export S3_ACCESS_KEY="secret_access_key"
./scripts/s3upload.sh
```




