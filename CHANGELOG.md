# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

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
