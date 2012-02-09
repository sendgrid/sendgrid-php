# sendgrid-php #
This library allows you to quickly and easily send emails through SendGrid using php

## License ##
Licensed under the MIT License.

## Install ##
```
git clone git@github.com:sendgrid/sendgrid-php.git
```

## SendGrid APIs ##
SendGrid provides two methods of sending email: the Web API, and SMTP API.  SendGrid recommends using the SMTP API for sending emails.
For an explanation of the benefits of each, refer to http://docs.sendgrid.com/documentation/get-started/integrate/examples/smtp-vs-rest/.

This library implements a common interface to make it very easy to use either API.

## Usage ##
To begin using this library, you must first include it
```php
include 'path/to/sendgrid-php/SendGrid_loader.php';
```

Initialize the SendGrid object with your SendGrid credentials
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
