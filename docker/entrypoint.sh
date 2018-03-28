#! /bin/sh
clear

# check for + link mounted libraries:
if [ -d /mnt/sendgrid-php ]
then
	rm /root/sendgrid
	ln -s /mnt/sendgrid-php/sendgrid
	echo "Linked mounted sendgrid-php's code to /root/sendgrid"
fi
if [ -d /mnt/php_http_client ]
then
	rm /root/php_http_client
	ln -s /mnt/php-http-client/php_http_client
	echo "Linked mounted php-http-client's code to /root/php_http_client"
fi

SENDGRID_PHP_VERSION=$(php --version|head -1)
echo "Welcome to sendgrid-php docker v${SENDGRID_PHP_VERSION}."
echo

if [ "$1" != "--no-mock" ]
then
	echo "Starting Prism in mock mode. Calls made to Prism will not actually send emails."
	echo "Disable this by running this container with --no-mock."
	prism run --mock --spec $OAI_SPEC_URL 2> /dev/null &
else
	echo "Starting Prism in live (--no-mock) mode. Calls made to Prism will send emails."
	prism run --spec $OAI_SPEC_URL 2> /dev/null  &
fi
echo "To use Prism, make API calls to localhost:4010. For example,"
echo "    sg = sendgrid.SendGridAPIClient("
echo "        host='http://localhost:4010/',"
echo "        api_key=os.environ.get('SENDGRID_API_KEY_CAMPAIGNS'))"
echo "To stop Prism, run \"kill $!\" from the shell."

echo
echo "Starting PHP. You can 'use Namespace\Package' to import them into context."
echo

php -a
