# Change Log
All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](http://semver.org/).

[2021-11-17] Version 7.11.0
---------------------------
**Library - Feature**
- [PR #1065](https://github.com/sendgrid/sendgrid-php/pull/1065): add spam, bounce and unsubscribe bypass management filters. Thanks to [@shwetha-manvinkurke](https://github.com/shwetha-manvinkurke)!


[2021-10-18] Version 7.10.0
---------------------------
**Library - Feature**
- [PR #1061](https://github.com/sendgrid/sendgrid-php/pull/1061): allow personalization of the From name and email for each email recipient. Thanks to [@beebzz](https://github.com/beebzz)!

**Library - Docs**
- [PR #1060](https://github.com/sendgrid/sendgrid-php/pull/1060): improve signed webhook event validation docs. Thanks to [@shwetha-manvinkurke](https://github.com/shwetha-manvinkurke)!


[2021-01-27] Version 7.9.2
--------------------------
**Library - Fix**
- [PR #1030](https://github.com/sendgrid/sendgrid-php/pull/1030): Fixing namespace for classes on test/unit folder. Thanks to [@peter279k](https://github.com/peter279k)!


[2020-11-18] Version 7.9.1
--------------------------
**Library - Docs**
- [PR #980](https://github.com/sendgrid/sendgrid-php/pull/980): Incorrect links in Use Cases, section Email Stats. Thanks to [@kampalex](https://github.com/kampalex)!


[2020-11-05] Version 7.9.0
--------------------------
**Library - Feature**
- [PR #674](https://github.com/sendgrid/sendgrid-php/pull/674): Allows for a user to utilize self-signed certificates. Thanks to [@davcpas1234](https://github.com/davcpas1234)!

**Library - Test**
- [PR #704](https://github.com/sendgrid/sendgrid-php/pull/704): Adding php static analysis. Thanks to [@reisraff](https://github.com/reisraff)!


[2020-10-14] Version 7.8.5
--------------------------
**Library - Docs**
- [PR #1009](https://github.com/sendgrid/sendgrid-php/pull/1009): Incorrect value order in example array for addAttachments. Thanks to [@Anorris-NLR](https://github.com/Anorris-NLR)!


[2020-09-28] Version 7.8.4
--------------------------
**Library - Fix**
- [PR #1006](https://github.com/sendgrid/sendgrid-php/pull/1006): don't wrap names in double-quotes. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Library - Chore**
- [PR #725](https://github.com/sendgrid/sendgrid-php/pull/725): Require conformance to style standards. Thanks to [@jmauerhan](https://github.com/jmauerhan)!


[2020-09-02] Version 7.8.3
--------------------------
**Library - Fix**
- [PR #1001](https://github.com/sendgrid/sendgrid-php/pull/1001): support 'to' addresses with subjects. Thanks to [@childish-sambino](https://github.com/childish-sambino)!


[2020-08-19] Version 7.8.2
--------------------------
**Library - Docs**
- [PR #717](https://github.com/sendgrid/sendgrid-php/pull/717): Update documentation for retrieving a list of all templates. Thanks to [@renshuki](https://github.com/renshuki)!
- [PR #729](https://github.com/sendgrid/sendgrid-php/pull/729): Added S3 attachment example. Thanks to [@semijoelon](https://github.com/semijoelon)!
- [PR #984](https://github.com/sendgrid/sendgrid-php/pull/984): Reduce excessive comments in code examples. Thanks to [@kampalex](https://github.com/kampalex)!

**Library - Test**
- [PR #735](https://github.com/sendgrid/sendgrid-php/pull/735): add unit tests for lib/email. Thanks to [@peter279k](https://github.com/peter279k)!
- [PR #756](https://github.com/sendgrid/sendgrid-php/pull/756): Add more scenarios for email address encoding. Thanks to [@2mt-heuser](https://github.com/2mt-heuser)!

**Library - Chore**
- [PR #993](https://github.com/sendgrid/sendgrid-php/pull/993): update GitHub branch references to use HEAD. Thanks to [@thinkingserious](https://github.com/thinkingserious)!


[2020-08-05] Version 7.8.1
--------------------------
**Library - Fix**
- [PR #755](https://github.com/sendgrid/sendgrid-php/pull/755): remove loader.php and update CONTRIBUTING.md. Thanks to [@mkasberg](https://github.com/mkasberg)!


[2020-07-22] Version 7.8.0
--------------------------
**Library - Chore**
- [PR #990](https://github.com/sendgrid/sendgrid-php/pull/990): migrate to new default sendgrid-oai branch. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Library - Docs**
- [PR #778](https://github.com/sendgrid/sendgrid-php/pull/778): fix grammar issue in CHANGELOG. Thanks to [@Hestersue43](https://github.com/Hestersue43)!
- [PR #759](https://github.com/sendgrid/sendgrid-php/pull/759): add Email Activity API to usage docs. Thanks to [@ajloria](https://github.com/ajloria)!

**Library - Feature**
- [PR #850](https://github.com/sendgrid/sendgrid-php/pull/850): Add an option to override SendGrid Client path version. Thanks to [@erbaker](https://github.com/erbaker)!
- [PR #762](https://github.com/sendgrid/sendgrid-php/pull/762): enhanced type exception handling. Thanks to [@misantron](https://github.com/misantron)!


[2020-07-08] Version 7.7.0
--------------------------
**Library - Feature**
- [PR #985](https://github.com/sendgrid/sendgrid-php/pull/985): Additional check for existence of Composer autoloader. Thanks to [@kampalex](https://github.com/kampalex)!
- [PR #978](https://github.com/sendgrid/sendgrid-php/pull/978): Mail constructor: Added support for array of Substitution instances using $globalSubstitutions. Thanks to [@kampalex](https://github.com/kampalex)!

**Library - Fix**
- [PR #976](https://github.com/sendgrid/sendgrid-php/pull/976): allow a float type as a substitution value in transactional templates. Thanks to [@thinkingserious](https://github.com/thinkingserious)!
- [PR #977](https://github.com/sendgrid/sendgrid-php/pull/977): Mail constructor: Verify arguments $plainTextContent and $htmlContent if provided. Thanks to [@kampalex](https://github.com/kampalex)!
- [PR #971](https://github.com/sendgrid/sendgrid-php/pull/971): Optional Personalization arguments handling. Thanks to [@kampalex](https://github.com/kampalex)!


[2020-06-10] Version 7.6.0
--------------------------
**Library - Fix**
- [PR #975](https://github.com/sendgrid/sendgrid-php/pull/975): Inspected code of Stats, example helpers. Thanks to [@kampalex](https://github.com/kampalex)!
- [PR #967](https://github.com/sendgrid/sendgrid-php/pull/967): add support for unicode in local part of email address when using PHP>=7.1. Thanks to [@kampalex](https://github.com/kampalex)!
- [PR #974](https://github.com/sendgrid/sendgrid-php/pull/974): Accept string typed Subject in Personalization. Thanks to [@kampalex](https://github.com/kampalex)!
- [PR #973](https://github.com/sendgrid/sendgrid-php/pull/973): Replace dynamic template data typehints. Thanks to [@kampalex](https://github.com/kampalex)!

**Library - Feature**
- [PR #969](https://github.com/sendgrid/sendgrid-php/pull/969): verify signature from event webhook. Thanks to [@childish-sambino](https://github.com/childish-sambino)!


[2020-05-27] Version 7.5.2
--------------------------
**Library - Fix**
- [PR #966](https://github.com/sendgrid/sendgrid-php/pull/966): Rename 'BaseInterface' to 'BaseSendGridClientInterface.php'. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #965](https://github.com/sendgrid/sendgrid-php/pull/965): use classmap instead of files for Composer autoload. Thanks to [@kampalex](https://github.com/kampalex)!

**Library - Docs**
- [PR #839](https://github.com/sendgrid/sendgrid-php/pull/839): add documentation for segments in USAGE.md. Thanks to [@rwhirn](https://github.com/rwhirn)!


[2020-05-13] Version 7.5.1
--------------------------
**Library - Fix**
- [PR #960](https://github.com/sendgrid/sendgrid-php/pull/960): migrate to common prism setup. Thanks to [@childish-sambino](https://github.com/childish-sambino)!


[2020-04-29] Version 7.5.0
--------------------------
**Library - Fix**
- [PR #952](https://github.com/sendgrid/sendgrid-php/pull/952): refactor and fix personalization inserts/updates. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Library - Feature**
- [PR #951](https://github.com/sendgrid/sendgrid-php/pull/951): add support for Twilio Email. Thanks to [@childish-sambino](https://github.com/childish-sambino)!


[2020-04-01] Version 7.4.6
--------------------------
**Library - Docs**
- [PR #947](https://github.com/sendgrid/sendgrid-php/pull/947): support verbiage for login issues. Thanks to [@adamchasetaylor](https://github.com/adamchasetaylor)!
- [PR #946](https://github.com/sendgrid/sendgrid-php/pull/946): correct params order in example.php. Thanks to [@spaze](https://github.com/spaze)!


[2020-03-18] Version 7.4.5
--------------------------
**Library - Docs**
- [PR #749](https://github.com/sendgrid/sendgrid-php/pull/749): add @throws to docblock. Thanks to [@iPoul](https://github.com/iPoul)!


[2020-03-04] Version 7.4.4
--------------------------
**Library - Chore**
- [PR #941](https://github.com/sendgrid/sendgrid-php/pull/941): add PHP 7.4 to Travis and test with lowest dependencies. Thanks to [@childish-sambino](https://github.com/childish-sambino)!


[2020-02-19] Version 7.4.3
--------------------------
**Library - Fix**
- [PR #918](https://github.com/sendgrid/sendgrid-php/pull/918): resolve deprecation notices when using Composer 1.10(-dev). Thanks to [@kampalex](https://github.com/kampalex)!
- [PR #939](https://github.com/sendgrid/sendgrid-php/pull/939): drop the prism binary and ignore unneeded files from the archive. Thanks to [@childish-sambino](https://github.com/childish-sambino)!


[2020-01-22] Version 7.4.2
--------------------------
**Library - Docs**
- [PR #928](https://github.com/sendgrid/sendgrid-php/pull/928): baseline all the templated markdown docs. Thanks to [@childish-sambino](https://github.com/childish-sambino)!


[2020-01-09] Version 7.4.1
--------------------------
**Library - Docs**
- [PR #710](https://github.com/sendgrid/sendgrid-php/pull/710): correct the *.md files using Grammarly. Thanks to [@myzeprog](https://github.com/myzeprog)!
- [PR #742](https://github.com/sendgrid/sendgrid-php/pull/742): properly capitalize brands GitHub and SendGrid. Thanks to [@aslafy-z](https://github.com/aslafy-z)!
- [PR #737](https://github.com/sendgrid/sendgrid-php/pull/737): remove `sudo` requirement for running docker. Thanks to [@jamietanna](https://github.com/jamietanna)!

**Library - Chore**
- [PR #926](https://github.com/sendgrid/sendgrid-php/pull/926): prep the repo for automated releasing. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Library - Fix**
- [PR #765](https://github.com/sendgrid/sendgrid-php/pull/765): correct typo in PR template from "Sendgrid" to "SendGrid". Thanks to [@JoeRomeo](https://github.com/JoeRomeo)!
- [PR #757](https://github.com/sendgrid/sendgrid-php/pull/757): remove dead code when setting the subject. Thanks to [@2mt-heuser](https://github.com/2mt-heuser)!
- [PR #761](https://github.com/sendgrid/sendgrid-php/pull/761): correct the License file path in ReadMe. Thanks to [@sanjaysingh](https://github.com/sanjaysingh)!
- [PR #770](https://github.com/sendgrid/sendgrid-php/pull/770): update the link for cURL example in Troubleshooting.MD. Thanks to [@music-mind](https://github.com/music-mind)!
- [PR #887](https://github.com/sendgrid/sendgrid-php/pull/887): correct the mail helper readme link in example. Thanks to [@flashadvocate](https://github.com/flashadvocate)!


[2019-12-11] Version 7.4.0
--------------------------

**Library - Fix**
- [PR #705](https://github.com/sendgrid/sendgrid-php/pull/705): Fixing issue #686: NULL Item in Personalizations. Thanks to [@reisraff](https://github.com/reisraff)!
- [PR #788](https://github.com/sendgrid/sendgrid-php/pull/788): Fixes #788 - Add missing parameter for addCc and addBcc methods. Thanks to [@hjmsw](https://github.com/hjmsw)!

**Library - Docs**
- [PR #836](https://github.com/sendgrid/sendgrid-php/pull/836): Update example.php. Add personalization example as per #792. Thanks to [@hjmsw](https://github.com/hjmsw)!

**Library - Feature**
- [PR #841](https://github.com/sendgrid/sendgrid-php/pull/841): Make $emailAddress on TypeException to be evaluated. Thanks to [@yehudah](https://github.com/yehudah)!

## [7.3.0] - 2019-04-15 ##
### Fixed
- PR [#821](https://github.com/sendgrid/sendgrid-php/pull/821): PHP 7.3 support and fix Prism download problem.
- Closes [#669](https://github.com/sendgrid/sendgrid-php/issues/669), PR [#670](https://github.com/sendgrid/sendgrid-php/pull/670): Fix Mail::setGlobalSubject(). Thanks to [Spencer Salisbury](https://github.com/smsalisbury) for the solution!
- Closes [#782](https://github.com/sendgrid/sendgrid-php/issues/782), PR [#783](https://github.com/sendgrid/sendgrid-php/pull/783): Remove references to 'whitelabel'. Thanks to [Chandler Weiner](https://github.com/crweiner) for the solution!
- Closes [#763](https://github.com/sendgrid/sendgrid-php/issues/763), PR [#764](https://github.com/sendgrid/sendgrid-php/pull/764): Update link to license. Thanks to [Pranjal Vyas](https://github.com/vyaspranjal33) for the solution!
- PR [#760](https://github.com/sendgrid/sendgrid-php/pull/760): Clean up Prism shell script. Thanks to [gy741](https://github.com/gy741) for the solution!
- Closes [#739](https://github.com/sendgrid/sendgrid-php/issues/739), PR [#740](https://github.com/sendgrid/sendgrid-php/pull/740): . Thanks to [Alex Borisov](https://github.com/smrtab) for the solution!

### Added
- PR [#828](https://github.com/sendgrid/sendgrid-php/pull/828): Update Twilio branding, CLA policy.
- Closes [#768](https://github.com/sendgrid/sendgrid-php/issues/768), PR [#769](https://github.com/sendgrid/sendgrid-php/pull/769): Update prerequisites. Thanks to [Rishabh](https://github.com/Rishabh04-02) for the solution!
- Closes [#733](https://github.com/sendgrid/sendgrid-php/issues/733), PR [#736](https://github.com/sendgrid/sendgrid-php/pull/736): Update CONTRIBUTING - contribution guideline to branch off development. Thanks to [Alex](https://github.com/myzeprog) for the solution!
- Closes [#481](https://github.com/sendgrid/sendgrid-php/issues/481), PR [#743](https://github.com/sendgrid/sendgrid-php/pull/743): Added Box attachment example. Thanks to [Joel](https://github.com/semijoelon) for the solution!
- Closes [#690](https://github.com/sendgrid/sendgrid-php/issues/690), PR [#698](https://github.com/sendgrid/sendgrid-php/pull/698): Update prism version. Thanks to [Gergo Juhasz](https://github.com/geryjuhasz) for the solution!

## [7.2.1] - 2018-09-18 ##
### Fixed
- Closes [#671](https://github.com/sendgrid/sendgrid-php/issues/671), PR [#689](https://github.com/sendgrid/sendgrid-php/pull/689): isBase64 function returning incorrect. Thanks to [Jmky](https://github.com/Jmky) for the solution!

## [7.2.0] - 2018-08-15 ##
### Added
- Closes [#648](https://github.com/sendgrid/sendgrid-php/issues/648), PR [#657](https://github.com/sendgrid/sendgrid-php/pull/657): Allow for Dynamic Templates Implementation. Thanks to [Mike Willbanks](https://github.com/mwillbanks) for the PR!

## [7.1.1] - 2018-08-15 ##
### Fixed
- Closes [#667](https://github.com/sendgrid/sendgrid-php/issues/667), PR [#668](https://github.com/sendgrid/sendgrid-php/pull/668): isBase64 function fix. Thanks to [Tigran M](https://github.com/developer-devPHP) for bringing this to our attention!

## [7.1.0] - 2018-08-14 ##
### Added

- Closes [#612](https://github.com/sendgrid/sendgrid-php/issues/612), PR [#652](https://github.com/sendgrid/sendgrid-php/pull/652): Fixes #612 Add TypeException and include type validations in classes inside mail/. Thanks to [James Harding](https://github.com/hjmsw) for the PR!
- Closes [#551](https://github.com/sendgrid/sendgrid-php/issues/551), PR [#571](https://github.com/sendgrid/sendgrid-php/pull/571): Add ability to impersonate subuser. Thanks to [Stian Prestholdt](https://github.com/stianpr) for the PR!
- Closes [#617](https://github.com/sendgrid/sendgrid-php/issues/617), PR [#651](https://github.com/sendgrid/sendgrid-php/pull/651): Add try / catch to examples. Thanks to [James Harding](https://github.com/hjmsw) for the PR!
- Closes [#619](https://github.com/sendgrid/sendgrid-php/issues/619), PR [#620](https://github.com/sendgrid/sendgrid-php/pull/620): PHPDoc & code improvements. Thanks to [Martijn Melchers](https://github.com/martijnmelchers) for the PR!
- Closes [#610](https://github.com/sendgrid/sendgrid-php/issues/610), PR [#628](https://github.com/sendgrid/sendgrid-php/pull/628): Removes unnecessary linter warning from phpcs. Thanks to [James Harding](https://github.com/hjmsw) for the PR!
- Closes [#608](https://github.com/sendgrid/sendgrid-php/issues/611), PR [#626](https://github.com/sendgrid/sendgrid-php/pull/626): Add check so that getContents() always returns content with MimeType text/plain first in array of Content objects. Thanks to [James Harding](https://github.com/hjmsw) for the PR!
- Closes [#611](https://github.com/sendgrid/sendgrid-php/issues/611), PR [#618](https://github.com/sendgrid/sendgrid-php/pull/618): Attachments now automatically get base64 encoded if they are not already. Thanks to [Martijn Melchers](https://github.com/martijnmelchers) for the PR!
- PR [#661](https://github.com/sendgrid/sendgrid-php/pull/661): Add Code Triage tag. Thanks to [Anshul Singhal](https://github.com/af4ro) for the PR!
- PR [#663](https://github.com/sendgrid/sendgrid-php/pull/663): Improve Contributing.md readability. Thanks to [Anshul Singhal](https://github.com/af4ro) for the PR!

### Fixed
- PR [#631](https://github.com/sendgrid/sendgrid-php/pull/631): Broken documentation link. Thanks to [David Duman](https://github.com/dvdnhm) for the PR!
- PR [#633](https://github.com/sendgrid/sendgrid-php/pull/633): Fixes for non-composer environments. Thanks to [Tom Gordon](https://github.com/apcro) for the PR!
- PR [#634](https://github.com/sendgrid/sendgrid-php/pull/634): Fixes missing file extension. Thanks to [Muberra Duman Demirtepe](https://github.com/muberraduman) for the PR!
- PR [#658](https://github.com/sendgrid/sendgrid-php/pull/658): Corrected PHP Syntax. Thanks to [David Passmore](https://github.com/davcpas1234) for the PR!
- Fixes [#624](https://github.com/sendgrid/sendgrid-php/issues/624), PR [#625](https://github.com/sendgrid/sendgrid-php/pull/625): Fix setGroupsToDisplay's handling of array arguments. Thanks to [Mo Ismailzai](https://github.com/moismailzai) for the PR!

## [7.0.0] - 2018-05-19 ##
### BREAKING CHANGE

Thanks to the [strong support and feedback of the SendGrid PHP community](https://github.com/sendgrid/sendgrid-php/issues/434), we have a new version of this SDK that should be a big improvement in the developer experience for this SDK.

In particular, I'd like to make special mention of [@caseyw](https://github.com/caseyw), [@vitya1](https://github.com/vitya1), [@Braunson](https://github.com/Braunson), [@cbschuld](https://github.com/cbschuld), [@paoga87](https://github.com/paoga87), [@Taluu](https://github.com/Taluu), [@mazanax](https://github.com/mazanax), [@ninsuo](https://github.com/ninsuo), [@ianh2](https://github.com/ianh2), [@WadeShuler](https://github.com/WadeShuler), [@jaimehing](https://github.com/jaimehing), [@KnightAR](https://github.com/KnightAR), [@alextech](https://github.com/alextech) (my apologies if I've missed you)

Since this is a major departure from v6.X, we advise you to refactor your code according to the documentation found in the [README](README.md) and [USE_CASES](USE_CASES.md) files. We hope you find the new interface much easier to work with. Please open an [issue](https://github.com/sendgrid/sendgrid-php/issues) or PR if you run into any trouble or have any feedback.

If you wish to continue using previous versions of this SDK, no problem. However, we will not be updating versions less than v7 except for critical bugs and/or security issues.

We hope this will be the last breaking change in the foreseeable future; that said, let the iterations begin!

## [6.2.0] - 2018-03-28 ##
### Added
- Closes [#454](https://github.com/sendgrid/sendgrid-php/issues/454), PR [#502](https://github.com/sendgrid/sendgrid-php/pull/502):
Add helper for adding new recipients to your contactdb via a webform, thanks to [Kraig Hufstedler](https://github.com/kraigh) for the PR!

- Closes [#487](https://github.com/sendgrid/sendgrid-php/issues/487), PR [#506](https://github.com/sendgrid/sendgrid-php/pull/506):
Add helper to get all stats from a specified data range, thanks to [Milos Pejanovic](https://github.com/runz0rd) for the PR!

- Closes [#368](https://github.com/sendgrid/sendgrid-php/issues/368), PR [#511](https://github.com/sendgrid/sendgrid-php/pull/511):
Add support for commas and semicolns in email name, thanks to [Quentin Ligier](https://github.com/qligier) for the PR!

- Closes [#491](https://github.com/sendgrid/sendgrid-php/issues/491), PR [#493](https://github.com/sendgrid/sendgrid-php/pull/493:
Allow for setting attachment content from path, thanks to [rparpa](https://github.com/rparpa) for the PR!

## [6.1.0] - 2018-03-27 ##
### Added
- PR [#512](https://github.com/sendgrid/sendgrid-php/pull/512): Omit PHP closing tag in use case sample, thanks to [Sébastien Santoro](https://github.com/dereckson) for the PR!

- PR [#575](https://github.com/sendgrid/sendgrid-php/pull/575): Add an example to the README.md describing how to send emails as HTML as the content type, thanks to [Benjamin Manford](https://github.com/manfordbenjamin) for the PR!

- Closes [#547](https://github.com/sendgrid/sendgrid-php/issues/547), PR [#549](https://github.com/sendgrid/sendgrid-php/pull/549):
Added Code Review to Contributing.md, thanks to [tomhorvat](https://github.com/tomhorvat) for the PR!

- PR [#565](https://github.com/sendgrid/sendgrid-php/pull/565): Add PHP 7.1 and 7.2 to Travis build matrix, thanks to [Emir Beganović](https://github.com/emirb) for the PR!

- PR [#577](https://github.com/sendgrid/sendgrid-php/pull/577): Update PHP Version terms, thanks to [Siddhant Sharma](https://github.com/ssiddhantsharma) for the PR!

- Closes [#540](https://github.com/sendgrid/sendgrid-php/issues/540), PR [#543](https://github.com/sendgrid/sendgrid-php/pull/543):
Feature/split unit tests, thanks to [Owen Voke](https://github.com/pxgamer) for the PR!

- Closes [#441](https://github.com/sendgrid/sendgrid-php/issues/441), PR [#467](https://github.com/sendgrid/sendgrid-php/pull/467):
Add deploy to heroku button, thanks to [pangaunn](https://github.com/pangaunn) for the PR!

- Closes [#423](https://github.com/sendgrid/sendgrid-php/issues/423), PR [#510](https://github.com/sendgrid/sendgrid-php/pull/510):
Adding Google App engine installation with composer instructions, thanks to [Nalin Bhardwaj](https://github.com/nalinbhardwaj) for the PR!

- Closes [#541](https://github.com/sendgrid/sendgrid-php/issues/541), PR [#542](https://github.com/sendgrid/sendgrid-php/pull/542):
Added CodeCov support, thanks to [Owen Voke](https://github.com/pxgamer) for the PR!

- PR [#539](https://github.com/sendgrid/sendgrid-php/pull/539): Rename LICENSE.txt to md, thanks to [Ankit Jain](https://github.com/ankitjain28may) for the PR!

- Closes [#436](https://github.com/sendgrid/sendgrid-php/issues/436), PR [#535](https://github.com/sendgrid/sendgrid-php/pull/535): Add docker development setup, thanks to [Samundra Shrestha](https://github.com/samundra) for the PR!

- Closes [#532](https://github.com/sendgrid/sendgrid-php/issues/532), PR [#537](https://github.com/sendgrid/sendgrid-php/pull/537): Add license date range unit test, thanks to [uppe-r](https://github.com/uppe-r) for the PR!

- Closes [#533](https://github.com/sendgrid/sendgrid-php/issues/533), PR [#536](https://github.com/sendgrid/sendgrid-php/pull/536): Add unit test to check that specific files exist in repo, thanks to [Bertus Steenberg](https://github.com/bertuss) for the PR!

- Closes [#524](https://github.com/sendgrid/sendgrid-php/issues/524), PR [#527](https://github.com/sendgrid/sendgrid-php/pull/527): Created code climate YML file, thanks to [Prashu Chaudhary](https://github.com/prashuchaudhary) for the PR!

- Closes [#520](https://github.com/sendgrid/sendgrid-php/issues/520), PR [#523](https://github.com/sendgrid/sendgrid-php/pull/523): Added sample env file, thanks to [Joey Lee](https://github.com/yeoji) for the PR!

- PR [#519](https://github.com/sendgrid/sendgrid-php/pull/519): Add github PR template, thanks to [Alex](https://github.com/pushkyn) for the PR!

- PR [#513](https://github.com/sendgrid/sendgrid-php/pull/513): Update to PHP 7.0.0 refactor - Fix syntax error in refactor documentation, thanks to [Sébastien Santoro](https://github.com/dereckson) for the PR!

- PR [#505](https://github.com/sendgrid/sendgrid-php/pull/505): Update README.md with additional badges, thanks to [Lalit Vijay](https://github.com/lalitvj) for the PR!

- Closes [#500](https://github.com/sendgrid/sendgrid-php/issues/500), PR [#504](https://github.com/sendgrid/sendgrid-php/pull/504): SEO Friendly Section links, thanks to [Dharma Saputra](https://github.com/ladhadha) for the PR!

- PR [#503](https://github.com/sendgrid/sendgrid-php/pull/503): Added new badges to README.md, thanks to [Alex](https://github.com/myzeprog) for the PR!

- Closes [#492](https://github.com/sendgrid/sendgrid-php/issues/492), PR [#494](https://github.com/sendgrid/sendgrid-php/pull/494): Demonstrate how to review the request body for troubleshooting, thanks to [Alex](https://github.com/myzeprog) for the PR!

- PR [#476](https://github.com/sendgrid/sendgrid-php/pull/476): Update README.md with license information, thanks to [Tarmo Leppänen](https://github.com/tarlepp) for the PR!

- PR [#475](https://github.com/sendgrid/sendgrid-php/pull/475): Add documentation for setting up domain whitelabel, thanks to [Sourav Sarkar](https://github.com/amsourav) for the PR!

- PR [#468](https://github.com/sendgrid/sendgrid-php/pull/463): Changes the recommendation to use composer as recommended source, thanks to [Gabriela D'Ávila Ferrara](https://github.com/gabidavila) for the PR!

- PR [#463](https://github.com/sendgrid/sendgrid-php/pull/463): Add TROUBLESHOOTING.md section about fixing error 415, thanks to [AlbinoDrought](https://github.com/AlbinoDrought) for the PR!

- PR [#456](https://github.com/sendgrid/sendgrid-php/pull/456): Added Code of Conduct, thanks to [Rubemlrm](https://github.com/Rubemlrm) for the PR!

- PR [#439](https://github.com/sendgrid/sendgrid-php/pull/439): Update to PHP 7.0.0 refactor - Removal of Collections, thanks to [Joseph Opanel](https://github.com/jopanel) for the PR!

- PR [#416](https://github.com/sendgrid/sendgrid-php/pull/416): Add release notifications, thanks to [Gabriel Krell](https://github.com/gabrielkrell) for the PR!

- PR [#415](https://github.com/sendgrid/sendgrid-php/pull/415): Updated example.php to fix that there was no way for the sections to get substituted without their being a substitution that calls them, thanks to [Kyle Roberts](https://github.com/kylearoberts) for the PR!

### Fixed
- PR [#545](https://github.com/sendgrid/sendgrid-php/pull/545): Fix typo CONTRIBUTING.md, thanks to [thepriefy](https://github.com/thepriefy) for the PR!

- PR [#588](https://github.com/sendgrid/sendgrid-php/pull/588): Fix broken unit tests

- PR [#576](https://github.com/sendgrid/sendgrid-php/pull/576): API level addressing of the string-only in addSubstitution arg rule. Every long integer triggers a bad request, thanks to [Ezequiel Villarreal](https://github.com/saruman) for the PR!

- PR [#517](https://github.com/sendgrid/sendgrid-php/pull/517): Fix typos in USAGE.md, thanks to [Anatoly](https://github.com/anatolyyyyyy) for the PR!

- PR [#530](https://github.com/sendgrid/sendgrid-php/pull/530): Changed the license period., thanks to [Siddhant Sharma](https://github.com/ssiddhantsharma) for the PR!

- PR [#514](https://github.com/sendgrid/sendgrid-php/pull/514): Don't close img tag in HTML, thanks to [Sébastien Santoro](https://github.com/dereckson) for the PR!

- PR [#507](https://github.com/sendgrid/sendgrid-php/pull/507): Fix typos in various files, thanks to [Brandon Smith](https://github.com/brandon93s) for the PR!

- Fixes [#336](https://github.com/sendgrid/sendgrid-php/issues/336), PR [#479](https://github.com/sendgrid/sendgrid-php/pull/479): Incorrect documentation path fixed, thanks to [Valerian Pereira](https://github.com/valerianpereira) for the PR!

- PR [#465](https://github.com/sendgrid/sendgrid-php/pull/465): Fix typo in README.md, thanks to [shra1cumar](https://github.com/shra1cumar) for the PR!

- PR [#449](https://github.com/sendgrid/sendgrid-php/pull/449): Fix typos in USAGE.md, thanks to [Cícero Pablo](https://github.com/ciceropablo) for the PR!

- PR [#448](https://github.com/sendgrid/sendgrid-php/pull/448): Fix typos in TROUBLESHOOTING.md, thanks to [Cícero Pablo](https://github.com/ciceropablo) for the PR!

- PR [#435](https://github.com/sendgrid/sendgrid-php/pull/435): Change spam_report() to spam_reports() in documentation and examples, thanks to [mrmxs](https://github.com/mrmxs) for the PR!

- PR [#431](https://github.com/sendgrid/sendgrid-php/pull/431): Fixed minor typo during Mail creation, thanks to [joeldixon66](https://github.com/joeldixon66) for the PR!

## [6.0.0] - 2017-06-30 ##
### BREAKING CHANGE
- PR #408: Update Mail constructor to signify which parameters are required for sending all email
- The `Mail()` constructor now requires `$from`, `$subject`, `$to` and `$content` parameters like so: `Mail($from, $subject, $to, $content)`. Those are the minimally required parameters to send an email.
- Thanks to [Casey Wilson](https://github.com/caseyw) for the PR!

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
- Added a [USE_CASES.md](USE_CASES.md) section, with the first use case example for transactional templates

## [5.0.7] - 2016-07-25 ##
### Added
- [Troubleshooting](TROUBLESHOOTING.md) section

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
