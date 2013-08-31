<?php
namespace SendGridFake;

/**
 * This class is here to support the unit tests for the Autoloader.
 * Issue #33 was that the SendGrid Autoloader was matching classes not in the SendGrid namespace, but which contained
 * the word SendGrid in the namespace (like 'Sendgrid-Php-Library').
 *
 * @package SendGridFake
 */
class Example {

}