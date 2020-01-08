.PHONY: clean install ci-install test bundle

clean:
	@rm -rf vendor composer.lock sendgrid-php.zip

install:
	composer install

ci-install:
	composer install --no-dev

test:
	vendor/bin/phpunit test/unit --filter test*

bundle: clean ci-install
	zip -r sendgrid-php.zip . -x \*.git\* \*composer.json\* \*scripts\* \*test\* \*.travis.yml\* \*prism\*
