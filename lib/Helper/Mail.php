<?php

namespace SendGrid\Helper;

/**
 * The final request body object
 * Class Mail
 * @package SendGrid\Helper
 */
class Mail implements \JsonSerializable
{
    const VERSION = '1.0.0';

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

    /**
     * Mail constructor.
     * @param null $from
     * @param null $subject
     * @param null $to
     * @param null $content
     */
    public function __construct($from = null, $subject = null, $to = null, $content = null)
    {
        if (!empty($from) &&  !empty($subject) && !empty($to) && !empty($content))
        {
            $this->setFrom($from);
            $personalization = new Personalization();
            $personalization->addTo($to);
            $this->addPersonalization($personalization);
            $this->setSubject($subject);
            $this->addContent($content);
        }

    }

    public function setFrom($email)
    {
        $this->from = $email;
        return $this;
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
        return $this;
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
        return $this;
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
        $this->custom_args[$key] = $value;
    }

    public function getCustomArgs()
    {
        return $this->custom_args;
    }

    public function setSendAt($send_at)
    {
        $this->send_at = $send_at;
        return $this;
    }

    public function getSendAt()
    {
        return $this->send_at;
    }

    public function setBatchId($batch_id)
    {
        $this->batch_id = $batch_id;
        return $this;
    }

    public function getBatchId()
    {
        return $this->batch_id;
    }

    public function setASM($asm)
    {
        $this->asm = $asm;
        return $this;
    }

    public function getASM()
    {
        return $this->asm;
    }

    public function setIpPoolName($ip_pool_name)
    {
        $this->ip_pool_name = $ip_pool_name;
        return $this;
    }

    public function getIpPoolName()
    {
        return $this->ip_pool_name;
    }

    public function setMailSettings($mail_settings)
    {
        $this->mail_settings = $mail_settings;
        return $this;
    }

    public function getMailSettings()
    {
        return $this->mail_settings;
    }

    public function setTrackingSettings($tracking_settings)
    {
        $this->tracking_settings = $tracking_settings;
        return $this;
    }

    public function getTrackingSettings()
    {
        return $this->tracking_settings;
    }

    public function setReplyTo($reply_to)
    {
        $this->reply_to = $reply_to;
        return $this;
    }

    public function getReplyTo()
    {
        return $this->reply_to;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'from' => $this->getFrom(),
                'personalizations' => $this->getPersonalizations(),
                'subject' => $this->getSubject(),
                'content' => $this->getContents(),
                'attachments' => $this->getAttachments(),
                'template_id' => $this->getTemplateId(),
                'sections' => $this->getSections(),
                'headers' => $this->getHeaders(),
                'categories' => $this->getCategories(),
                'custom_args' => $this->getCustomArgs(),
                'send_at' => $this->getSendAt(),
                'batch_id' => $this->getBatchId(),
                'asm' => $this->getASM(),
                'ip_pool_name' => $this->getIpPoolName(),
                'mail_settings' => $this->getMailSettings(),
                'tracking_settings' => $this->getTrackingSettings(),
                'reply_to' => $this->getReplyTo()
            ]
        );
    }
}
