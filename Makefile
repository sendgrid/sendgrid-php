.PHONY: clean install ci-install test bundle

clean:
	@rm -rf vendor composer.lock sendgrid-php.zip

install: clean
	composer install

ci-install: clean
	composer install --no-dev

test: install
	vendor/bin/phpunit test/unit --filter test*

bundle: ci-install
	zip -r sendgrid-php.zip . -x \*.git\* \*composer.json\* \*scripts\* \*test\* \*.travis.yml\* \*prism\*
