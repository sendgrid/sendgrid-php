# First time contributors

Start by cloning the repository with git: `git clone https://github.com/sendgrid/sendgrid-php.git`.

If you are not using git, simply download and install the [latest packaged release of the library as a zip](https://github.com/sendgrid/sendgrid-php/archive/master.zip).

Install [composer](https://getcomposer.org/download/) and the dependencies with `composer install`.

## Find a task

You can find issues that are [labelled with "difficulty: easy"](https://github.com/sendgrid/sendgrid-php/issues?q=is%3Aopen+label%3A%22difficulty%3A+easy%22+label%3A%22status%3A+help+wanted%22) in this repository.

## Run the tests

[PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki) is used to check the coding style of the project that ensures the code remains clean and consistent. Use `vendor/bin/phpcs lib/` to scan the code and detect problems. Some of the issues can also be automatically resolved with the following command: `vendor/bin/phpcbf lib/`.

Unit tests are added to see wether the codebase produced results match the expectations and assert that no code regression has occurred in other parts of the codebase. Use `vendor/bin/phpunit . --filter test*` to run the tests. You should create new tests that guarantee that new code works as intended. See [PHPUnit documentation](https://phpunit.de/documentation.html) on how to write tests.

## Create a Pull Request (PR)

1. You first have to [fork](https://help.github.com/articles/fork-a-repo/) this repository in GitHub.
2. (Optionnal) Clone the repository:
```
git clone https://github.com/<your name>/sendgrid-php
cd sendgrid-php
```
3. Modify the codebase as you want, either in local or in GitHub and commit it: `git commit -m "Description of the changes" && git push origin branch`.
4. [Create a Pull Request](https://help.github.com/articles/using-pull-requests/) in GitHub and follow the template to describe it.
