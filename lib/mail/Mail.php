<?php namespace SendGrid\Mail;
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
/**
  * The final request body object
  */
class Mail implements \JsonSerializable
{
    const VERSION = '1.0.0';

    protected $namespace = 'SendGrid';

    private $from;
    private $subject;
    private $contents;
    private $attachments;
    private $template_id;
    private $sections;
    private $headers;
    private $categories;
    private $custom_args;
    private $substitutions;
    private $send_at;
    private $batch_id;
    private $asm;
    private $ip_pool_name;
    private $mail_settings;
    private $tracking_settings;
    private $reply_to;

    public $personalization = null;

    public function __construct(
        $from = null,
        $to = null,
        $subject = null,
        $plainTextContent = null,
        $htmlContent = null,
        array $globalSubstitutions = null
    ) {
        if (!$from
            && !$to
            && !$subject
            && !$plainTextContent
            && !$htmlContent
            && !$globalSubstitutions
        ) {
            return;
        }
        $this->setFrom($from);
        if (!is_array($subject)) {
            $this->setSubject($subject);
            $subjectCount = null;
        } else {
            $subjectCount = 1;
        }
        if (!is_array($to)) {
            $to = [ $to ];
        }
        foreach ($to as $email) {
            $personalization = new Personalization();
            $personalization->addTo($email);
            if ($subs = $email->getSubstitions()) {
                foreach ($subs as $key => $value) {
                    $personalization->addSubstitution($key, $value);
                }
            }
            if (is_array($subject)) {
                $personalization->setSubject($subject[$subjectCount - 1]);
                $subjectCount++;
            } else {
                if ($subject = $email->getSubject()) {
                    $personalization->setSubject($subject);
                }
            }
            if (is_array($globalSubstitutions)) {
                foreach ($globalSubstitutions as $key => $value) {
                    $personalization->addSubstitution($key, $value);
                }
            }
            $this->addPersonalization($personalization);
        }
        $this->addContent($plainTextContent);
        $this->addContent($htmlContent);
    }

    public function setFrom($email, $name=null)
    {
        if ($name != null ) {
            $this->from = new From($email, $name);
        } else {
            $this->from = $email;
        }
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function addRecipientEmail(
        $emailType,
        $email,
        $name = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $personalizationFunctionCall = "add".$emailType;
        $emailType = "\SendGrid\Mail\\".$emailType;
        if ($name != null) {
            $email = new $emailType($email, $name);
        }
        if ($personalization != null) {
            $personalization->$personalizationFunctionCall($email);
            $this->addPersonalization($personalization);
            return;
        } else {
            if ($this->personalization[0] != null) {
                $this->personalization[0]->$personalizationFunctionCall($email);
                return;
            } elseif ($this->personalization[$personalizationIndex] != null) {
                $this->personalization[$personalizationIndex]->$personalizationFunctionCall($email);
                return;
            } else {
                $personalization = new Personalization();
                $personalization->$personalizationFunctionCall($email);
                if (($personalizationIndex != 0)
                    && ($this->getPersonalizationCount() <= $personalizationIndex)
                ) {
                    $this->personalization[$personalizationIndex] = $personalization;
                } else {
                    $this->addPersonalization($personalization);
                }
                return;
            }
        }
    }

    public function addRecipientEmails(
        $emailType,
        $emails,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $emailFunctionCall = "add".$emailType;
        if ($emails[0] instanceof EmailAddress) {
            foreach ($emails as $email) {
                $this->$emailFunctionCall(
                    $email,
                    $name = null,
                    $personalizationIndex,
                    $personalization
                );
            }
        } else {
            foreach ($emails as $email => $name) {
                $this->$emailFunctionCall(
                    $email,
                    $name,
                    $personalizationIndex,
                    $personalization
                );
            }
        }
    }

    public function addTo(
        $to,
        $name = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $this->addRecipientEmail(
            "To",
            $to,
            $name,
            $personalizationIndex,
            $personalization
        );
    }

    public function addTos(
        $toEmails,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $this->addRecipientEmails(
            "To",
            $toEmails,
            $personalizationIndex,
            $personalization
        );
    }

    public function addCc(
        $cc,
        $name = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $this->addRecipientEmail(
            "Cc",
            $cc,
            $name,
            $personalizationIndex,
            $personalization
        );
    }

    public function addCcs(
        $ccEmails,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $this->addRecipientEmails(
            "Cc",
            $ccEmails,
            $personalizationIndex,
            $personalization
        );
    }

    public function addBcc(
        $bcc,
        $name = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $this->addRecipientEmail(
            "Bcc",
            $bcc,
            $name,
            $personalizationIndex,
            $personalization
        );
    }

    public function addBccs(
        $bccEmails,
        $personalizationIndex = null,
        $personalization = null) {
            $this->addRecipientEmails(
                "Bcc",
                $bccEmails,
                $personalizationIndex,
                $personalization
            );
    }

    public function addPersonalization($personalization)
    {
        $this->personalization[] = $personalization;
    }

    public function getPersonalizations()
    {
        return $this->personalization;
    }

    public function setSubject(
        $subject,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if ($subject instanceof Subject) {
            $subject = $subject;
        } else {
            $subject = new Subject($subject);
        }
        if ($personalization != null) {
            $personalization->setSubject($subject);
            $this->addPersonalization($personalization);
            return;
        } else {
            if ($this->personalization[0] != null) {
                $this->personalization[0]->setSubject($subject);
                return;
            } elseif ($this->personalization[$personalizationIndex] != null) {
                $this->personalization[$personalizationIndex]->setSubject($subject);
                return;
            } else {
                $personalization = new Personalization();
                $personalization->setSubject($subject);
                if (($personalizationIndex != 0)
                    && ($this->getPersonalizationCount() <= $personalizationIndex)
                ) {
                    $this->personalization[$personalizationIndex] = $personalization;
                } else {
                    $this->addPersonalization($personalization);
                }
                return;
            }
        }
    }

    public function getSubject($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getSubject();
    }

    public function setGlobalSubject($subject)
    {
        if ($subject instanceof Subject) {
            $subject = $subject;
        } else {
            $subject = new Subject($subject);
        }
        $this->subject = $subject;
    }

    public function getGlobalSubject()
    {
        return $this->subject;
    }

    public function addContent($content, $value = null)
    {
        if ($content instanceof Content) {
            $content = $content;
        } else {
            $content = new Content($content);
        }
        $this->contents[] = $content;
    }

    public function addContents($contents)
    {
        if ($contents[0] instanceof Content) {
            foreach ($contents as $content) {
                $this->addContent($content);
            }
        } else {
            foreach ($contents as $key => $value) {
                $this->addContent($key, $value);
            }
        }
    }    

    public function getContents()
    {
        // TODO: Ensure text/plain is always first
        return $this->contents;
    }

    public function addAttachment(
        $attachment,
        $type = null,
        $filename = null,
        $disposition = null,
        $content_id = null
    ) {
        if ($attachment instanceof Attachment) {
            $attachment = $attachment;
        } else {
            $attachment = new Attachment(
                $attachment,
                $type,
                $filename,
                $disposition,
                $content_id
            );
        }
        $this->attachments[] = $attachment;
    }

    public function addAttachments($attachments)
    {
        foreach ($attachments as $attachment) {
            $this->addAttachment($attachment);
        }
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

    public function addHeader(
        $key,
        $value=null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $header = null;
        if ($key instanceof Header) {
            $h = $key;
            $header = new Header($h->getKey(), $h->getValue());
        } else {
            $header = new Header($key, $value);
        }
        if ($personalization != null) {
            $personalization->addHeader($header);
            $this->addPersonalization($personalization);
            return;
        } else {
            if ($this->personalization[0] != null) {
                $this->personalization[0]->addHeader($header);
            } elseif ($this->personalization[$personalizationIndex] != null) {
                $this->personalization[$personalizationIndex]->addHeader($header);
            } else {
                $personalization = new Personalization();
                $personalization->addHeader($header);
                if (($personalizationIndex != 0)
                    && ($this->getPersonalizationCount() <= $personalizationIndex)
                ) {
                    $this->personalization[$personalizationIndex] = $personalization;
                } else {
                    $this->addPersonalization($personalization);
                }
            }
            return;
        }
    }

    public function addHeaders($headers)
    {
        if ($headers[0] instanceof Header) {
            foreach ($headers as $header) {
                $this->addHeader($header);
            }
        } else {
            foreach ($headers as $key => $value) {
                $this->addHeader($key, $value);
            }
        }
    }

    public function getHeaders($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getHeaders();
    }

    public function getGlobalheaders()
    {
        return $this->headers;
    }

    public function addSubstitution(
        $key,
        $value=null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $substitution = null;
        if ($key instanceof Substitution) {
            $s = $key;
            $substitution = new Substitution($s->getKey(), $s->getValue());
        } else {
            $substitution = new Substitution($key, $value);
        }
        if ($personalization != null) {
            $personalization->addSubstitution($substitution);
            $this->addPersonalization($personalization);
            return;
        } else {
            if ($this->personalization[0] != null) {
                $this->personalization[0]->addSubstitution($substitution);
            } elseif ($this->personalization[$personalizationIndex] != null) {
                $this->personalization[$personalizationIndex]->addSubstitution($substitution);
            } else {
                $personalization = new Personalization();
                $personalization->addSubstitution($substitution);
                if (($personalizationIndex != 0)
                    && ($this->getPersonalizationCount() <= $personalizationIndex)
                ) {
                    $this->personalization[$personalizationIndex] = $personalization;
                } else {
                    $this->addPersonalization($personalization);
                }
            }
            return;
        }
    }

    public function addSubstitutions($substitutions)
    {
        if ($substitutions[0] instanceof Substitution) {
            foreach ($substitutions as $substitution) {
                $this->addSubstitution($substitution);
            }
        } else {
            foreach ($substitutions as $key => $value) {
                $this->addSubstitution($key, $value);
            }
        }
    }

    public function getSubstitutions($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getSubstitutions();
    }

    public function addGlobalSubstitution($key, $value=null)
    {
        if ($key instanceof Substitution) {
            $substitution = $key;
            $this->substitutions[$substitution->getKey()]
                = $substitution->getValue();
            return;
        }
        $this->substitutions[$key] = $value;
    }

    public function addGlobalSubstitutions($substitutions)
    {
        if ($substitutions[0] instanceof Substitution) {
            foreach ($substitutions as $substitution) {
                $this->addGlobalSubstitution($substitution);
            }
        } else {
            foreach ($substitutions as $key => $value) {
                $this->addGlobalSubstitution($key, $value);
            }
        }
    }

    public function getGlobalSubstitutions()
    {
        return $this->substitutions;
    }

    public function addCategory($category)
    {
        $this->categories[] = $category;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function addCustomArg(
        $key,
        $value=null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $custom_arg = null;
        if ($key instanceof CustomArg) {
            $ca = $key;
            $custom_arg = new CustomArg($ca->getKey(), $ca->getValue());
        } else {
            $custom_arg = new CustomArg($key, $value);
        }
        if ($personalization != null) {
            $personalization->addCustomArg($custom_arg);
            $this->addPersonalization($personalization);
            return;
        } else {
            if ($this->personalization[0] != null) {
                $this->personalization[0]->addCustomArg($custom_arg);
            } elseif ($this->personalization[$personalizationIndex] != null) {
                $this->personalization[$personalizationIndex]->addCustomArg($custom_arg);
            } else {
                $personalization = new Personalization();
                $personalization->addCustomArg($custom_arg);
                if (($personalizationIndex != 0)
                    && ($this->getPersonalizationCount() <= $personalizationIndex)
                ) {
                    $this->personalization[$personalizationIndex] = $personalization;
                } else {
                    $this->addPersonalization($personalization);
                }
            }
            return;
        }
    }

    public function addCustomArgs($custom_args)
    {
        if ($custom_args[0] instanceof CustomArg) {
            foreach ($custom_args as $custom_arg) {
                $this->addCustomArg($custom_arg);
            }
        } else {
            foreach ($custom_args as $key => $value) {
                $this->addCustomArg($key, $value);
            }
        }
    }    

    public function getCustomArgs($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getCustomArgs();
    }

    public function addGlobalCustomArg($key, $value=null)
    {
        if ($key instanceof CustomArg) {
            $custom_arg = $key;
            $this->custom_args[$custom_arg->getKey()]
                = $custom_arg->getValue();
            return;
        }
        $this->custom_args[$key] = (string)$value;
    }

    public function addGlobalCustomArgs($custom_args)
    {
        if ($custom_args[0] instanceof CustomArg) {
            foreach ($custom_args as $custom_arg) {
                $this->addGlobalCustomArg($custom_arg);
            }
        } else {
            foreach ($custom_args as $key => $value) {
                $this->addGlobalCustomArg($key, $value);
            }
        }
    }

    public function getGlobalCustomArgs()
    {
        return $this->custom_args;
    }

    public function setSendAt(
        $send_at,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if ($send_at instanceof SendAt) {
            $send_at = $send_at;
        } else {
            $send_at = new SendAt($send_at);
        }
        if ($personalization != null) {
            $personalization->setSendAt($send_at);
            $this->addPersonalization($personalization);
            return;
        } else {
            if ($this->personalization[0] != null) {
                $this->personalization[0]->setSendAt($send_at);
                return;
            } elseif ($this->personalization[$personalizationIndex] != null) {
                $this->personalization[$personalizationIndex]->setSendAt($send_at);
                return;
            } else {
                $personalization = new Personalization();
                $personalization->setSendAt($send_at);
                if (($personalizationIndex != 0)
                    && ($this->getPersonalizationCount() <= $personalizationIndex)
                ) {
                    $this->personalization[$personalizationIndex] = $personalization;
                } else {
                    $this->addPersonalization($personalization);
                }
                return;
            }
        }
    }

    public function getSendAt($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getSendAt();
    }    

    public function setGlobalSendAt($send_at)
    {
        if ($send_at instanceof SendAt) {
            $send_at = $send_at;
        } else {
            $send_at = new SendAt($send_at);
        }
        $this->send_at = $send_at;
    }

    public function getGlobalSendAt()
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
                'subject'           => $this->getGlobalSubject(),
                'content'           => $this->getContents(),
                'attachments'       => $this->getAttachments(),
                'template_id'       => $this->getTemplateId(),
                'sections'          => $this->getSections(),
                'headers'           => $this->getGlobalHeaders(),
                'categories'        => $this->getCategories(),
                'custom_args'       => $this->getGlobalCustomArgs(),
                'substitutions'     => $this->getGlobalSubstitutions(),
                'send_at'           => $this->getGlobalSendAt(),
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
