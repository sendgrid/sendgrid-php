.PHONY: clean install ci-install test test-integ test-docker bundle

clean:
	@rm -rf vendor composer.lock sendgrid-php.zip

install: clean
ifdef GIT_HUB_TOKEN
	composer config -g github-oauth.github.com $(GIT_HUB_TOKEN)
endif

	composer install

ifeq ($(dependencies), lowest)
	composer update --prefer-lowest --prefer-stable -n
endif

ci-install: clean
	composer install --no-dev

test:
	vendor/bin/phpunit test/unit --filter test*
	vendor/bin/phpcs lib/*/*

test-integ: test
	vendor/bin/phpunit test --filter test*

version ?= latest
test-docker:
	curl -s https://raw.githubusercontent.com/sendgrid/sendgrid-oai/HEAD/prism/prism.sh -o prism.sh
	dependencies=lowest version=$(version) bash ./prism.sh
	dependencies=highest version=$(version) bash ./prism.sh

bundle: ci-install
	zip -r sendgrid-php.zip . -x \*.git\* \*composer.json\* \*scripts\* \*test\* \*.travis.yml\* \*prism\*
