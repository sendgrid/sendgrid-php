# Change Log
All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](http://semver.org/).

## [5.6.2] - 2017-06-29 ##
### Fix
- PR #410: Adding name for ReplyTo for issue #390
- Thanks to [Casey Wilson](https://github.com/caseyw) for the PR!

## [5.6.1] - 2017-06-26 ##
### Fix
- Versioning mistake (forgot the .0 at the end)

## [5.6.0] - 2017-06-26 ##
### Added
- Pull #405: Updating docs and non-composer includes
- Thanks to [Casey Wilson](https://github.com/caseyw) for the PR!

## [5.5.1] - 2017-05-18 ##
### Fixed
- Pull #396: Use `print_r` instead of `echo` on Arrays
- Thanks to [Ryan P.C. McQuen](https://github.com/ryanpcmcquen) for the PR!

## [5.5.0] - 2017-05-04 ##
### Added
- Pull #393: Update [php-http-client](https://github.com/sendgrid/php-http-client) dependency
- [v3.6](https://github.com/sendgrid/php-http-client/releases/tag/v3.6.0): Pass the curlOptions to the client in buildClient
- [v3.7](https://github.com/sendgrid/php-http-client/releases/tag/v3.7.0): Added ability to get headers as associative array

## [5.4.2] - 2017-04-18 ##
### Fixes
- Fixes #292
- Removes Prism file in sendgrid-php.zip

## [5.4.1] - 2017-04-04 ##
### Added
- Pull #373
- PSR1 & PSR2 Conversion
- Thanks to [Braunson Yager](https://github.com/Braunson) for the PR!

## [5.4.0] - 2017-03-16 ##
### Added
- Pull #337
- API level addressing of the string-only custom arg rule
- Thanks to [Chris Schuld](https://github.com/cbschuld) for the PR!

## [5.3.0] - 2017-03-15 ##
### Added
- Pull #367
- UTF8 encoding forced for content value and message subject
- Thanks to [Chris Schuld](https://github.com/cbschuld) for the PR!

## [5.2.3] - 2017-03-03 ##
### Fixed
- Pull #334
- Fixed serialization of empty JSON objects, fixes #332 & #314
- Thanks to [Matthew Dreyer](https://github.com/Dreyer) for the PR!

## [5.2.2] - 2017-03-03 ##
### Fixed
- Pull #323
- Typo 'user' for 'usr'
- Thanks to [Mike Ralphson](https://github.com/MikeRalphson) for the PR!

## [5.2.1] - 2017-03-01 ##
### Fixed
- Pull #353
- Fixed Issue #352
- Relative path fix for background jobs
- Thanks to [Tarcísio Zotelli Ferraz](https://github.com/tarcisiozf) for the PR!

## [5.2.0] - 2017-02-23 ##
### Added
- Pull #346
- Allow passing curlOptions to the client
- Thanks to [Taluu](https://github.com/sendgrid/sendgrid-php/pull/346) for the PR!

## [5.1.2] - 2016-10-11 ##
### Added
- Pull #330, Fixes #320
- Delete subaccounts returns 200 issue resolved
- The fix happened at the [php-http-client](https://github.com/sendgrid/php-http-client/releases/tag/v3.5.1) dependency.
- Thanks to [emil](https://github.com/emilva) for the PR!

## [5.1.1] - 2016-10-11 ##
### Added
- Pull #307, Fixes #276
- Adds phpdoc and style fixes
- Thanks to [Avishkar Autar](https://github.com/aautar) for the PR!

## [5.1.0] - 2016-09-29 ##
### Fixed
- Pull #295: [Upgrade sendgrid/php-http-client](https://github.com/sendgrid/sendgrid-php/pull/295/files)
- This adds getters for certain properties, please see [this pull request](https://github.com/sendgrid/php-http-client/pull/9) for details
- Thanks to [Arjan Keeman](https://github.com/akeeman) for the pull request!

## [5.0.9] - 2016-09-13 ##
### Fixed
- Pull request #289: [Replace "\jsonSerializable" with "\JsonSerializable" ](https://github.com/sendgrid/sendgrid-php/pull/289)
- Thanks to [Issei.M](https://github.com/issei-m) for the pull request!

## [5.0.8] - 2016-08-24 ##
### Added
- Table of Contents in the README
- Added a [USE_CASES.md](https://github.com/sendgrid/sendgrid-php/blob/master/USE_CASES.md) section, with the first use case example for transactional templates

## [5.0.7] - 2016-07-25 ##
### Added
- [Troubleshooting](https://github.com/sendgrid/sendgrid-php/blob/master/TROUBLESHOOTING.md) section

## [5.0.6] - 2016-07-20 ##
### Added
- README updates
- Update introduction blurb to include information regarding our forward path
- Update the v3 /mail/send example to include non-helper usage
- Update the generic v3 example to include non-fluent interface usage

## [5.0.5] - 2016-07-12 ##
### Added
- Update docs, unit tests and examples to include Sender ID

## [5.0.4] - 2016-07-07 ##
### Added
- Tests now mocked automatically against [prism](https://stoplight.io/prism/)

## [5.0.3] - 2016-07-05 ##
### Updated
- Content based on our updated [Swagger/OAI doc](https://github.com/sendgrid/sendgrid-oai)

## [5.0.2] - 2016-07-05 ##
### Added
- Accept: application/json header per https://sendgrid.com/docs/API_Reference/Web_API_v3/How_To_Use_The_Web_API_v3/requests.html

### Updated
- Content based on our updated [Swagger/OAI doc](https://github.com/sendgrid/sendgrid-oai)

## [5.0.1] - 2016-06-17 ##
### Fixed
- Issue with packaged version for non-composer uses

## [5.0.0] - 2016-06-13 ##
### Added
- Breaking change to support the v3 Web API
- New HTTP client
- v3 Mail Send helper

## [v4.0.4] - (2016-02-18) ##
### Added
- Ability to add scopes to API Keys endpoint [POST]

## [v4.0.3] - (2016-02-18) ##
### Added
- API Keys endpoint [PUT]

## [v4.0.2] - (2015-12-15) ##
### Added
- Tests for API Keys endpoint [POST, PATCH, DELETE]

## [v4.0.1] - (2015-12-03) ##
### Fixed
- HTTP 406 Not Acceptable Errors [#177](https://github.com/sendgrid/sendgrid-php/issues/177)

## [v4.0.0] - (2015-10-16) ##
### Added
- Added support for accessing the [SendGrid Web API v3 endpoints](https://sendgrid.com/docs/API_Reference/Web_API_v3/index.html)
- Implemented part of the /api_keys, /groups and /suppressions endpoints

## [v3.2.0] - (2015-05-13) ##

### Added
- Specify Guzzle proxy via [#149](https://github.com/sendgrid/sendgrid-php/pull/149)
- Option to disable exception raising

## [v3.1.0] - (2015-04-27)
### Added
- Support for API keys

## [v3.0.0] - (2015-04-14)
### Fixed
- CC and BCC not working with SMTPAPI To

### Changed
- **Breaking:** A `\SendGrid\Exception` is now raised when response is not 200
- **Breaking:** `addTo` now uses the Web API parameter as opposed to the SMTPAPI Header. Substitutions will most likely break unless you update to use `addSmtpapiTo`
- The library now depends on Guzzle3
- Major refactoring

### Added
- **Breaking:** `send()` now returns an instance of `\SendGrid\Response`
- Numerous missing methods for new functionality
- `addSmtpapiTo` for using the SMTPAPI To

## [v2.2.1] - (2014-01-29)
### Fixed
- Fix turn_off_ssl_verification option via [#123](https://github.com/sendgrid/sendgrid-php/pull/123)

## [v2.2.0] - (2014-01-12)
### Changed
- Remove [Unirest](https://github.com/Mashape/unirest-php/) and replace with native cURL
- Add CHANGELOG.md
