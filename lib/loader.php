<?php
/**
 * Allows us to include one file instead of two when working without composer.
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */
require_once __DIR__ . '/SendGrid.php';
require_once __DIR__ . '/contacts/Recipient.php';
require_once __DIR__ . '/contacts/RecipientForm.php';
require_once __DIR__ . '/mail/EmailAddress.php';
require_once __DIR__ . '/mail/Asm.php';
require_once __DIR__ . '/mail/Attachment.php';
require_once __DIR__ . '/mail/BatchId.php';
require_once __DIR__ . '/mail/Bcc.php';
require_once __DIR__ . '/mail/BccSettings.php';
require_once __DIR__ . '/mail/BypassListManagement.php';
require_once __DIR__ . '/mail/Category.php';
require_once __DIR__ . '/mail/Cc.php';
require_once __DIR__ . '/mail/ClickTracking.php';
require_once __DIR__ . '/mail/Content.php';
require_once __DIR__ . '/mail/CustomArg.php';
require_once __DIR__ . '/mail/Footer.php';
require_once __DIR__ . '/mail/From.php';
require_once __DIR__ . '/mail/Ganalytics.php';
require_once __DIR__ . '/mail/GroupId.php';
require_once __DIR__ . '/mail/GroupsToDisplay.php';
require_once __DIR__ . '/mail/Header.php';
require_once __DIR__ . '/mail/HtmlContent.php';
require_once __DIR__ . '/mail/IpPoolName.php';
require_once __DIR__ . '/mail/Mail.php';
require_once __DIR__ . '/mail/MailSettings.php';
require_once __DIR__ . '/mail/MimeType.php';
require_once __DIR__ . '/mail/OpenTracking.php';
require_once __DIR__ . '/mail/Personalization.php';
require_once __DIR__ . '/mail/PlainTextContent.php';
require_once __DIR__ . '/mail/ReplyTo.php';
require_once __DIR__ . '/mail/Section.php';
require_once __DIR__ . '/mail/SandBoxMode.php';
require_once __DIR__ . '/mail/SendAt.php';
require_once __DIR__ . '/mail/SpamCheck.php';
require_once __DIR__ . '/mail/Subject.php';
require_once __DIR__ . '/mail/SubscriptionTracking.php';
require_once __DIR__ . '/mail/Substitution.php';
require_once __DIR__ . '/mail/TemplateId.php';
require_once __DIR__ . '/mail/TrackingSettings.php';
require_once __DIR__ . '/mail/To.php';
require_once __DIR__ . '/stats/Stats.php';
