# sendgrid-php
This library allows you to quickly and easily send emails through SendGrid using PHP.

## Installation

There are a number of ways to install the SendGrid PHP helper library.  Choose from the options outlined below:

### Composer

The easier way to install the SendGrid php library is using [Composer](http://getcomposer.org/).  Composer makes it easy
to install the library and all of its dependencies:

#### 1. Update your composer.json

If you already have a `composer.json`, just add the following to your require section:

```json
{
  "require": {
    "sendgrid/sendgrid": "~1.0.0"
  }
}
```
*For more info on creating a `composer.json`, check out [this guide](http://getcomposer.org/doc/01-basic-usage.md#composer-json-project-setup).*

#### 2. Install from packagist

To install the library and it's dependencies, make sure you have [composer installed](http://getcomposer.org/doc/01-basic-usage.md#installation) and type the following:

```bash
composer install
```

#### 3. Include autoload.php

Now that we have everything installed, all we need to do is require it from our php script.  Add the following to the top of your php script:

```php
require 'vendor/autoload.php';
```

This will include both the SendGrid library, and the SwiftMailer dependency.

### Git

You can also install the package from github, although you will have to manually install the dependencies (see the section on installing dependencies below):

```bash
git clone https://github.com/sendgrid/sendgrid-php.git
```

And the require the autoloader from your php script:

```php
require '../path/to/sendgrid-php/SendGrid_loader.php';
```

## Installing Dependenices

If you installed the library using composer or you're not planning on sending using SMTP, you can skip this section.  Otherwise, you will need to install
SwiftMailer (which sendgrid-php depends on).  You can install from pear using the following:

```bash
pear channel-discover pear.swiftmailer.org
pear install swift/swift
```


## Testing ##

The existing tests in the `Test` directory can be run using [PHPUnit](https://github.com/sebastianbergmann/phpunit/) with the following command:

````
phpunit Test/
```

## SendGrid APIs ##
SendGrid provides two methods of sending email: the Web API, and SMTP API.  SendGrid recommends using the SMTP API for sending emails.
For an explanation of the benefits of each, refer to http://docs.sendgrid.com/documentation/get-started/integrate/examples/smtp-vs-rest/.

This library implements a common interface to make it very easy to use either API.

## Mail Pre-Usage ##

Before we begin using the library, its important to understand a few things about the library architecture...

* The SendGrid Mail object is the means of setting mail data. In general, data can be set in three ways for most elements:
  1. set - reset the data, and initialize it to the given element. This will destroy previous data
  2. set (List) - for array based elements, we provide a way of passing the entire array in at once. This will also destroy previous data.
  3. add - append data to the list of elements.

* Sending an email is as simple as :
  1. Creating a SendGrid Instance
  1. Creating a SendGrid Mail object, and setting its data
  1. Sending the mail using either SMTP API or Web API.

## Mail Usage ##

To begin using this library, initialize the SendGrid object with your SendGrid credentials

```php
$sendgrid = new SendGrid('username', 'password');
```

Create a new SendGrid Mail object and add your message details

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

### Using Categories ###

Categories are used to group email statistics provided by SendGrid.

To use a category, simply set the category name.  Note: there is a maximum of 10 categories per email.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addCategory("Category 1")->
       addCategory("Category 2");
```


### Using Attachments ###

Attachments are currently file based only, with future plans for an in memory implementation as well.

File attachments are limited to 7 MB per file.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addAttachment("../path/to/file.txt");    
```

### Using From-Name and Reply-To

There are two handy helper methods for setting the From-Name and Reply-To for a
message

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       setReplyTo('someone.else@example.com')->
       setFromName('John Doe')->
       ...
```

### Using Substitutions ###

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

### Using Sections ###

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

### Using Unique Arguments ###

Unique Arguments are used for tracking purposes

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addUniqueArgument("Customer", "Someone")->
       addUniqueArgument("location", "Somewhere");
```

### Using Filter Settings ###

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

### Using Headers ###

Headers can be used to add existing sendgrid functionality (such as for categories or filters), or custom headers can be added as necessary.

```php
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       ...
       addHeader("category", "My New Category");
```
