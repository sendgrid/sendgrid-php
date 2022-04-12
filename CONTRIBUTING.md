Hello! Thank you for choosing to help contribute to one of the Twilio SendGrid open source libraries. There are many ways you can contribute and help is always welcome. We simply ask that you follow the following contribution policies.

All third party contributors acknowledge that any contributions they provide will be made under the same open source license that the open source project is provided under.

- [Feature Request](#feature-request)
- [Submit a Bug Report](#submit-a-bug-report)
  - [Please use our Bug Report Template](#please-use-our-bug-report-template)
- [Improvements to the Codebase](#improvements-to-the-codebase)
  - [Development Environment](#development-environment)
    - [Install and Run Locally](#install-and-run-locally)
      - [Prerequisites](#prerequisites)
      - [Initial setup:](#initial-setup)
  - [Environment Variables](#environment-variables)
      - [Execute:](#execute)
- [Understanding the Code Base](#understanding-the-codebase)
- [Testing](#testing)
- [Style Guidelines & Naming Conventions](#style-guidelines--naming-conventions)
- [Creating a Pull Request](#creating-a-pull-request)
- [Code Reviews](#code-reviews)

There are a few ways to contribute, which we'll enumerate below:

## Feature Request

If you'd like to make a feature request, please read this section.

The GitHub issue tracker is the preferred channel for library feature requests, but please respect the following restrictions:

- Please **search for existing issues** in order to ensure we don't have duplicate bugs/feature requests.
- Please be respectful and considerate of others when commenting on issues

## Submit a Bug Report

Note: DO NOT include your credentials in ANY code examples, descriptions, or media you make public.

A software bug is a demonstrable issue in the code base. In order for us to diagnose the issue and respond as quickly as possible, please add as much detail as possible into your bug report.

Before you decide to create a new issue, please try the following:

1. Check the GitHub issues tab if the identified issue has already been reported, if so, please add a +1 to the existing post.
2. Update to the latest version of this code and check if the issue has already been fixed
3. Copy and fill in the Bug Report Template we have provided below

### Please use our Bug Report Template

In order to make the process easier, we've included a [sample bug report template](ISSUE_TEMPLATE.md).

## Improvements to the Codebase

We welcome direct contributions to the sendgrid-php code base. Thank you!

Please note that we utilize the [Gitflow Workflow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow) for Git to help keep project development organized and consistent.

### Development Environment ###

#### Install and Run Locally ####

##### Prerequisites #####

- PHP version 7.3, 7.4, 8.0, or 8.1

##### Initial setup: #####

```bash
git clone https://github.com/sendgrid/sendgrid-php.git
cd sendgrid-php
composer install
```

### Environment Variables

First, get your free Twilio SendGrid account [here](https://sendgrid.com/free?source=sendgrid-php).

Next, update your environment with your [SENDGRID_API_KEY](https://app.sendgrid.com/settings/api_keys).

```bash
echo "export SENDGRID_API_KEY='YOUR_API_KEY'" > sendgrid.env
echo "sendgrid.env" >> .gitignore
source ./sendgrid.env
```

##### Execute: #####

See the [examples folder](examples) or [README](README.md) to get started quickly.

We prefer the use of the Composer autoloader by loading `vendor/autoload.php`.

The examples will load `sendgrid-php.php` which is in the project root. This file verifies the existence of the Composer autoloader and warns you if dependencies are missing.

## Understanding the Codebase

**/examples**

Working examples that demonstrate usage.

```bash
php examples/example.php
```

**/test/unit**

Unit tests for the HTTP client.

**/test/integration**

Unit tests for the HTTP client.

**/lib**

The interface to the Twilio SendGrid API. The subfolders are helpers.

## Testing

All PRs require passing tests before the PR will be reviewed. All test files are in the [`/test/unit`](test/unit) directory. For the purposes of contributing to this repo, please update or add relevant test files [here](test) with tests as you modify the code.

The integration tests require a Twilio SendGrid mock API in order to execute. We've simplified setting this up using Docker to run the tests. You will just need [Docker Desktop](https://docs.docker.com/get-docker/) and `make`.

Once these are available, simply execute the Docker test target to run all tests: `make test-docker`. This command can also be used to open an interactive shell into the container where this library is installed. To start a *bash* shell for example, use this command: `command=bash make test-docker`.

## Style Guidelines & Naming Conventions

Generally, we follow the style guidelines as suggested by the official language. However, we ask that you conform to the styles that already exist in the library. If you wish to deviate, please explain your reasoning.

- [PSR2 Coding Standards](http://www.php-fig.org/psr/psr-2/)

Please run your code through:

- [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer)

## Creating a Pull Request

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

3. Create a new topic branch off the `development` branch to
   contain your feature, change, or fix:

   ```bash
   git checkout development
   git checkout -b <topic-branch-name>
   ```

4. Commit your changes in logical chunks. Please adhere to these [git commit
   message guidelines](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html)
   or your code is unlikely to be merged into the main project. Use Git's
   [interactive rebase](https://help.github.com/articles/interactive-rebase)
   feature to tidy up your commits before making them public.

4a. Create tests.

4b. Create or update the example code that demonstrates the functionality of this change to the code.

5. Locally merge (or rebase) the upstream `development` branch into your topic branch:

   ```bash
   git pull [--rebase] upstream development
   ```

6. Push your topic branch up to your fork:

   ```bash
   git push origin <topic-branch-name>
   ```

7. [Open a Pull Request](https://help.github.com/articles/using-pull-requests/)
    with a clear title and description against the `development` branch. All tests must be passing before we will review the PR.

## Code Reviews

If you can, please look at open PRs and review them. Give feedback and help us merge these PRs much faster! If you don't know how, GitHub has some [great information on how to review a Pull Request](https://help.github.com/articles/about-pull-request-reviews/).
