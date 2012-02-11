# sendgrid-php #
This library allows you to quickly and easily send emails through SendGrid using PHP.

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

```
include 'path/to/sendgrid-php/SendGrid_loader.php';
```

Initialize the SendGrid object with your SendGrid credentials

```
$sendgrid = new SendGrid('username', 'password');
```

Create a new SendGrid Mail object and add your message details

```
$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       setFrom('me@bar.com')->
       setSubject('Subject goes here')->
       setText('Hello World!')->
       setHtml('<strong>Hello World!</strong>');
```

Send it using the API of your choice (SMTP or Web)

```
$sendgrid->smtp->send($mail);
```
Or 

```
$sendgrid->web->send($mail);
```
