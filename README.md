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

## Mail Pre-Usage ##

Before we begin using the library, its important to understand a few things about the library architecture...
a. The SendGrid Mail object is the primary means of setting mail data. Its composed of many useful ways of setting data. In general, data can be set in three ways for most elements:
  1. Set - reset the data, and initialize it to the given element. This will destroy previous data
  2. SetList - for array based elements, we provide a way of passing the entire array in at once
  3. add - for array based elements, you can append data to the list.

b. We have two transport mechanisms for sending mail, SMTP and WEB. The WEB does not implement a common REST interface, since it does not make use of GET, PUT, POST, DELETE. Instead, its REST-like, allowing GET and POST elements, simultaneously. In general, the differences and nuances between these transport mechanisms have been extracted to provide a more fluid interface.

c. Sending an email is as simple as :
  1. Creating a SendGrid Library Instance
  2. Creating a SendGrid Mail object, and setting its data
  3. Sending the mail using either SMTP or Web.

## Mail Usage ##

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
