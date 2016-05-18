
##### Prerequisites #####

* PHP 5.4 or greater
* [php-http-client](https://github.com/sendgrid/php-http-client)

##### Initial setup: #####

```bash
composer install
```

##### Execute: #####

See the [examples folder](https://github.com/sendgrid/sendgrid-php/tree/v3beta/examples) to get started quickly.

You will need to setup the following environment to use the SendGrid example:

```
echo "export SENDGRID_API_KEY='YOUR_API_KEY'" > sendgrid.env
echo "sendgrid.env" >> .gitignore
source ./sendgrid.env
```

<a name="understanding_the_codebase"></a>
## Understanding the Code Base

**/examples**

Working examples that demonstrate usage. To run the example code

```bash
php examples/example.php
```

**/test/unit**

Tests for HTTP client.

**/lib**

The interface to the SendGrid API.

<a name="testing"></a>
## Testing

All PRs require passing tests before the PR will be reviewed.

All test files are in the [`tests`](https://github.com/sendgrid/sendgrid-php/tree/v3beta/test/unit) directory.

For the purposes of contributing to this repo, please update the [`SendGridTest.php`](https://github.com/sendgrid/sendgrid-php/tree/v3beta/test/unit/SendGridTest.php) file with unit tests as you modify the code.

```bash
phpunit --bootstrap test/unit/bootstrap.php --filter test* test/unit
```

<a name="style_guidelines_and_naming_conventions"></a>
## Style Guidelines & Naming Conventions

Generally, we follow the style guidelines as suggested by the official language. However, we ask that you conform to the styles that already exist in the library. If you wish to deviate, please explain your reasoning.

* [pear coding standards](https://pear.php.net/manual/en/standards.php)

Please run your code through [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer)

## Creating a Pull Request<a name="creating_a_pull_request"></a>

1. [Fork](https://help.github.com/fork-a-repo/) the project, clone your fork,
   and configure the remotes:

   ```bash
   # Clone your fork of the repo into the current directory
   git clone https://github.com/sendgrid/sendgrid-php
   # Navigate to the newly cloned directory
   cd sendgrid-php
   # Assign the original repo to a remote called "upstream"
   git remote add upstream https://github.com/sendgrid/sendgrid-php
   ```

2. If you cloned a while ago, get the latest changes from upstream:

   ```bash
   git checkout <dev-branch>
   git pull upstream <dev-branch>
   ```

3. Create a new topic branch (off the main project development branch) to
   contain your feature, change, or fix:

   ```bash
   git checkout -b <topic-branch-name>
   ```

4. Commit your changes in logical chunks. Please adhere to these [git commit
   message guidelines](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html)
   or your code is unlikely be merged into the main project. Use Git's
   [interactive rebase](https://help.github.com/articles/interactive-rebase)
   feature to tidy up your commits before making them public.

4a. Create tests.

4b. Create or update the example code that demonstrates the functionality of this change to the code.

5. Locally merge (or rebase) the upstream development branch into your topic branch:

   ```bash
   git pull [--rebase] upstream master
   ```

6. Push your topic branch up to your fork:

   ```bash
   git push origin <topic-branch-name>
   ```

7. [Open a Pull Request](https://help.github.com/articles/using-pull-requests/)
    with a clear title and description against the `master` branch. All tests must be passing before we will review the PR.

If you have any additional questions, please feel free to [email](mailto:dx@sendgrid.com) us or create an issue in this repo.
