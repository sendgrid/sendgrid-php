# Twilio API helper library.
# See LICENSE file for copyright and license details.

define LICENSE
<?php

/**
 * SendGrid API helper library.
 *
 * @category  Services
 * @package   Services_SendGrid
 * @license   http://creativecommons.org/licenses/MIT/ MIT
 * @link      https://github.com/sendgrid/sendgrid-php
 */
endef
export LICENSE

all: test

clean:
	@rm -rf dist

PHP_FILES = `find dist -name \*.php`
dist: clean
	@mkdir dist
	@git archive master | (cd dist; tar xf -)
	@for php in $(PHP_FILES); do\
	  echo "$$LICENSE" > $$php.new; \
	  tail -n+2 $$php >> $$php.new; \
	  mv $$php.new $$php; \
	done

test:
	@echo running tests
	@phpunit --strict --colors --configuration Test/phpunit.xml

.PHONY: all clean dist test
