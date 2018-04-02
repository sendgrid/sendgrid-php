<?php
/**
  * This helper builds the request body for a /mail/send API call.
  *
  * PHP version 5.6, 7
  *
  * @author    Elmer Thomas <dx@sendgrid.com>
  * @copyright 2017 SendGrid
  * @license   https://opensource.org/licenses/MIT The MIT License
  * @version   GIT: <git_id>
  * @link      http://packagist.org/packages/sendgrid/sendgrid
  */
namespace SendGrid;

class ReplyTo implements \JsonSerializable
{
    private $email;
    private $name;

    public function __construct($email, $name = null)
    {
        $this->setEmail($email);

        if (!is_null($name)) {
            $this->setName($name);
        }
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        /*
            Issue #368
            ==========

            If the name is not wrapped in double quotes and contains a comma or
            semicolon, the API fails to parse it correctly.

            When wrapped in double quotes, commas, semicolons and unescaped single
            quotes are supported.
            Escaped double quotes are supported as well but will appear unescaped in
            the mail (e.g. "O\'Keefe").

            Double quotes will be shown in some email clients, so the name should
            only be wrapped when necessary.
        */

        // Only wrapp in double quote if comma or semicolon are found
        if (false !== strpos($name, ',') || false !== strpos($name, ';')) {
            // Unescape quotes
            $name = stripslashes(html_entity_decode($name, ENT_QUOTES));

            // Escape only double quotes
            $name = str_replace('"', '\\"', $name);

            // Wrapp in double quotes
            $name = '"' . $name . '"';
        }

        $this->name = (!empty($name)) ? $name : null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'email' => $this->getEmail(),
                'name' => $this->getName(),
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class ClickTracking implements \JsonSerializable
{
    private $enable;
    private $enable_text;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnableText($enable_text)
    {
        $this->enable_text = $enable_text;
    }

    public function getEnableText()
    {
        return $this->enable_text;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'      => $this->getEnable(),
                'enable_text' => $this->getEnableText()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class OpenTracking implements \JsonSerializable
{
    private $enable;
    private $substitution_tag;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setSubstitutionTag($substitution_tag)
    {
        $this->substitution_tag = $substitution_tag;
    }

    public function getSubstitutionTag()
    {
        return $this->substitution_tag;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'           => $this->getEnable(),
                'substitution_tag' => $this->getSubstitutionTag()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class SubscriptionTracking implements \JsonSerializable
{
    private $enable;
    private $text;
    private $html;
    private $substitution_tag;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function setSubstitutionTag($substitution_tag)
    {
        $this->substitution_tag = $substitution_tag;
    }

    public function getSubstitutionTag()
    {
        return $this->substitution_tag;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'           => $this->getEnable(),
                'text'             => $this->getText(),
                'html'             => $this->getHtml(),
                'substitution_tag' => $this->getSubstitutionTag()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class Ganalytics implements \JsonSerializable
{
    private $enable;
    private $utm_source;
    private $utm_medium;
    private $utm_term;
    private $utm_content;
    private $utm_campaign;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setCampaignSource($utm_source)
    {
        $this->utm_source = $utm_source;
    }

    public function getCampaignSource()
    {
        return $this->utm_source;
    }

    public function setCampaignMedium($utm_medium)
    {
        $this->utm_medium = $utm_medium;
    }

    public function getCampaignMedium()
    {
        return $this->utm_medium;
    }

    public function setCampaignTerm($utm_term)
    {
        $this->utm_term = $utm_term;
    }

    public function getCampaignTerm()
    {
        return $this->utm_term;
    }

    public function setCampaignContent($utm_content)
    {
        $this->utm_content = $utm_content;
    }

    public function getCampaignContent()
    {
        return $this->utm_content;
    }

    public function setCampaignName($utm_campaign)
    {
        $this->utm_campaign = $utm_campaign;
    }

    public function getCampaignName()
    {
        return $this->utm_campaign;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'       => $this->getEnable(),
                'utm_source'   => $this->getCampaignSource(),
                'utm_medium'   => $this->getCampaignMedium(),
                'utm_term'     => $this->getCampaignTerm(),
                'utm_content'  => $this->getCampaignContent(),
                'utm_campaign' => $this->getCampaignName()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class TrackingSettings implements \JsonSerializable
{
    private $click_tracking;
    private $open_tracking;
    private $subscription_tracking;
    private $ganalytics;

    public function setClickTracking($click_tracking)
    {
        $this->click_tracking = $click_tracking;
    }

    public function getClickTracking()
    {
        return $this->click_tracking;
    }

    public function setOpenTracking($open_tracking)
    {
        $this->open_tracking = $open_tracking;
    }

    public function getOpenTracking()
    {
        return $this->open_tracking;
    }

    public function setSubscriptionTracking($subscription_tracking)
    {
        $this->subscription_tracking = $subscription_tracking;
    }

    public function getSubscriptionTracking()
    {
        return $this->subscription_tracking;
    }

    public function setGanalytics($ganalytics)
    {
        $this->ganalytics = $ganalytics;
    }

    public function getGanalytics()
    {
        return $this->ganalytics;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'click_tracking'        => $this->getClickTracking(),
                'open_tracking'         => $this->getOpenTracking(),
                'subscription_tracking' => $this->getSubscriptionTracking(),
                'ganalytics'            => $this->getGanalytics()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class BccSettings implements \JsonSerializable
{
    private $enable;
    private $email;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'email'  => $this->getEmail()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class BypassListManagement implements \JsonSerializable
{
    private $enable;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class Footer implements \JsonSerializable
{
    private $enable;
    private $text;
    private $html;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'text'   => $this->getText(),
                'html'   => $this->getHtml()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class SandBoxMode implements \JsonSerializable
{
    private $enable;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }
    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class SpamCheck implements \JsonSerializable
{
    private $enable;
    private $threshold;
    private $post_to_url;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;
    }

    public function getThreshold()
    {
        return $this->threshold;
    }

    public function setPostToUrl($post_to_url)
    {
        $this->post_to_url = $post_to_url;
    }

    public function getPostToUrl()
    {
        return $this->post_to_url;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'      => $this->getEnable(),
                'threshold'   => $this->getThreshold(),
                'post_to_url' => $this->getPostToUrl()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class MailSettings implements \JsonSerializable
{
    private $bcc;
    private $bypass_list_management;
    private $footer;
    private $sandbox_mode;
    private $spam_check;

    public function setBccSettings($bcc)
    {
        $this->bcc = $bcc;
    }

    public function getBccSettings()
    {
        return $this->bcc;
    }

    public function setBypassListManagement($bypass_list_management)
    {
        $this->bypass_list_management = $bypass_list_management;
    }

    public function getBypassListManagement()
    {
        return $this->bypass_list_management;
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function setSandboxMode($sandbox_mode)
    {
        $this->sandbox_mode = $sandbox_mode;
    }

    public function getSandboxMode()
    {
        return $this->sandbox_mode;
    }

    public function setSpamCheck($spam_check)
    {
        $this->spam_check = $spam_check;
    }

    public function getSpamCheck()
    {
        return $this->spam_check;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'bcc'                    => $this->getBccSettings(),
                'bypass_list_management' => $this->getBypassListManagement(),
                'footer'                 => $this->getFooter(),
                'sandbox_mode'           => $this->getSandboxMode(),
                'spam_check'             => $this->getSpamCheck()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class ASM implements \JsonSerializable
{
    private $group_id;
    private $groups_to_display;

    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setGroupsToDisplay($group_ids)
    {
        $this->groups_to_display = $group_ids;
    }

    public function getGroupsToDisplay()
    {
        return $this->groups_to_display;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'group_id'          => $this->getGroupId(),
                'groups_to_display' => $this->getGroupsToDisplay()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class Attachment implements \JsonSerializable
{
    private $content;
    private $type;
    private $filename;
    private $disposition;
    private $content_id;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;
    }

    public function getDisposition()
    {
        return $this->disposition;
    }

    public function setContentID($content_id)
    {
        $this->content_id = $content_id;
    }

    public function getContentID()
    {
        return $this->content_id;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'content'     => $this->getContent(),
                'type'        => $this->getType(),
                'filename'    => $this->getFilename(),
                'disposition' => $this->getDisposition(),
                'content_id'  => $this->getContentID()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }

    public function setContentPath($string)
    {
        $rawContent = file_get_contents($string);

        if ($rawContent === false) {
            throw new \RuntimeException("Could not open file $string");
        }

        $this->content  = base64_encode($rawContent);
        $this->filename = $this->filename ?: basename($string);
    }
}

class Content implements \JsonSerializable
{
    private $type;
    private $value;

    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setValue($value)
    {
        $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type'  => $this->getType(),
                'value' => $this->getValue()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class Personalization implements \JsonSerializable
{
    private $tos;
    private $ccs;
    private $bccs;
    private $subject;
    private $headers;
    private $substitutions;
    private $custom_args;
    private $send_at;

    public function addTo($email)
    {
        $this->tos[] = $email;
    }

    public function getTos()
    {
        return $this->tos;
    }

    public function addCc($email)
    {
        $this->ccs[] = $email;
    }

    public function getCcs()
    {
        return $this->ccs;
    }

    public function addBcc($email)
    {
        $this->bccs[] = $email;
    }

    public function getBccs()
    {
        return $this->bccs;
    }

    public function setSubject($subject)
    {
        $this->subject = mb_convert_encoding($subject, 'UTF-8', 'UTF-8');
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function addSubstitution($key, $value)
    {
        $this->substitutions[$key] = (string)$value;
    }

    public function getSubstitutions()
    {
        return $this->substitutions;
    }

    public function addCustomArg($key, $value)
    {
        $this->custom_args[$key] = (string)$value;
    }

    public function getCustomArgs()
    {
        return $this->custom_args;
    }

    public function setSendAt($send_at)
    {
        $this->send_at = $send_at;
    }

    public function getSendAt()
    {
        return $this->send_at;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'to'            => $this->getTos(),
                'cc'            => $this->getCcs(),
                'bcc'           => $this->getBccs(),
                'subject'       => $this->subject,
                'headers'       => $this->getHeaders(),
                'substitutions' => $this->getSubstitutions(),
                'custom_args'   => $this->getCustomArgs(),
                'send_at'       => $this->getSendAt()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

class Email implements \JsonSerializable
{
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->setName($name);
        $this->setEmail($email);
    }

    public function setName($name)
    {
        /*
            Issue #368
            ==========

            If the name is not wrapped in double quotes and contains a comma or
            semicolon, the API fails to parse it correctly.

            When wrapped in double quotes, commas, semicolons and unescaped single
            quotes are supported.
            Escaped double quotes are supported as well but will appear unescaped in
            the mail (e.g. "O\'Keefe").

            Double quotes will be shown in some email clients, so the name should
            only be wrapped when necessary.
        */

        // Only wrapp in double quote if comma or semicolon are found
        if (false !== strpos($name, ',') || false !== strpos($name, ';')) {
            // Unescape quotes
            $name = stripslashes(html_entity_decode($name, ENT_QUOTES));

            // Escape only double quotes
            $name = str_replace('"', '\\"', $name);

            // Wrapp in double quotes
            $name = '"' . $name . '"';
        }

        $this->name = (!empty($name)) ? $name : null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'name'  => $this->getName(),
                'email' => $this->getEmail()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}

/**
  * The final request body object
  */
class Mail implements \JsonSerializable
{
    const VERSION = '1.0.0';

    protected $namespace = 'SendGrid';

    public $from;
    public $personalization;
    public $subject;
    public $contents;
    public $attachments;
    public $template_id;
    public $sections;
    public $headers;
    public $categories;
    public $custom_args;
    public $send_at;
    public $batch_id;
    public $asm;
    public $ip_pool_name;
    public $mail_settings;
    public $tracking_settings;
    public $reply_to;

    public function __construct($from, $subject, $to, $content)
    {
        $this->setFrom($from);
	    $this->setSubject($subject);
	    $personalization = new Personalization();
        $personalization->addTo($to);
        $this->addPersonalization($personalization);
        $this->addContent($content);
    }

    public function setFrom($email)
    {
        $this->from = $email;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function addPersonalization($personalization)
    {
        $this->personalization[] = $personalization;
    }

    public function getPersonalizations()
    {
        return $this->personalization;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function addContent($content)
    {
        $this->contents[] = $content;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function addAttachment($attachment)
    {
        $this->attachments[] = $attachment;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }

    public function setTemplateId($template_id)
    {
        $this->template_id = $template_id;
    }

    public function getTemplateId()
    {
        return $this->template_id;
    }

    public function addSection($key, $value)
    {
        $this->sections[$key] = $value;
    }

    public function getSections()
    {
        return $this->sections;
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function addCategory($category)
    {
        $this->categories[] = $category;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function addCustomArg($key, $value)
    {
        $this->custom_args[$key] = (string)$value;
    }

    public function getCustomArgs()
    {
        return $this->custom_args;
    }

    public function setSendAt($send_at)
    {
        $this->send_at = $send_at;
    }

    public function getSendAt()
    {
        return $this->send_at;
    }

    public function setBatchId($batch_id)
    {
        $this->batch_id = $batch_id;
    }

    public function getBatchId()
    {
        return $this->batch_id;
    }

    public function setASM($asm)
    {
        $this->asm = $asm;
    }

    public function getASM()
    {
        return $this->asm;
    }

    public function setIpPoolName($ip_pool_name)
    {
        $this->ip_pool_name = $ip_pool_name;
    }

    public function getIpPoolName()
    {
        return $this->ip_pool_name;
    }

    public function setMailSettings($mail_settings)
    {
        $this->mail_settings = $mail_settings;
    }

    public function getMailSettings()
    {
        return $this->mail_settings;
    }

    public function setTrackingSettings($tracking_settings)
    {
        $this->tracking_settings = $tracking_settings;
    }

    public function getTrackingSettings()
    {
        return $this->tracking_settings;
    }

    public function setReplyTo($reply_to)
    {
        $this->reply_to = $reply_to;
    }

    public function getReplyTo()
    {
        return $this->reply_to;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'from'              => $this->getFrom(),
                'personalizations'  => $this->getPersonalizations(),
                'subject'           => $this->getSubject(),
                'content'           => $this->getContents(),
                'attachments'       => $this->getAttachments(),
                'template_id'       => $this->getTemplateId(),
                'sections'          => $this->getSections(),
                'headers'           => $this->getHeaders(),
                'categories'        => $this->getCategories(),
                'custom_args'       => $this->getCustomArgs(),
                'send_at'           => $this->getSendAt(),
                'batch_id'          => $this->getBatchId(),
                'asm'               => $this->getASM(),
                'ip_pool_name'      => $this->getIpPoolName(),
                'mail_settings'     => $this->getMailSettings(),
                'tracking_settings' => $this->getTrackingSettings(),
                'reply_to'          => $this->getReplyTo()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
