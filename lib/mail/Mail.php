<?php
/**
 * This helper builds the request body for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a request body for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class Mail implements \JsonSerializable
{
    /** @var $from From Email address of the sender */
    private $from;

    /** @var $subject Subject Subject of the email */
    private $subject;

    /** @var $contents Content[] Content(s) of the email */
    private $contents;

    /** @var $attachments Attachment[] Email attachments */
    private $attachments;

    /** @var $template_id TemplateId Id of a template that you would like to use */
    private $template_id;

    /** @var $sections Section[] Key/value pairs that define block sections of code to be used as substitutions */
    private $sections;

    /** @var $headers Header[] Header names and the value to substitute for them */
    private $headers;

    /** @var $categories Category[] Category names for this message */
    private $categories;

    /** @var $custom_args CustomArg[] Values that are specific to the entire send that will be carried along with the email and its activity data */
    private $custom_args;

    /** @var $substitutions Substitution[] Substitutions that will apply to the text and html content of the body of your email, in addition to the subject and reply-to parameters */
    private $substitutions;

    /** @var $send_at SendAt A unix timestamp allowing you to specify when you want your email to be delivered */
    private $send_at;

    /** @var $batch_id BatchId This ID represents a batch of emails to be sent at the same time */
    private $batch_id;

    /** @var $asm ASM Specifies how to handle unsubscribes */
    private $asm;

    /** @var $ip_pool_name IpPoolName The IP Pool that you would like to send this email from */
    private $ip_pool_name;

    /** @var $mail_settings MailSettings A collection of different mail settings that you can use to specify how you would like this email to be handled */
    private $mail_settings;

    /** @var $tracking_settings TrackingSettings Settings to determine how you would like to track the metrics of how your recipients interact with your email */
    private $tracking_settings;

    /** @var $reply_to ReplyTo Email to be use when replied to */
    private $reply_to;

    /** @var $personalization Personalization[] Messages and their metadata */
    private $personalization;

    const   VERSION = "7.0.0";

    /**
     * If passing parameters into this constructor include
     * $from, $to, $subject, $plainTextContent and
     * $htmlContent at a minimum. In that case, a Personalization
     * object will be created for you.
     *
     * @param From|null $from Email address of the sender
     * @param To|To[]|null $to Recipient(s) email
     *                                                    address(es)
     * @param Subject|Subject[]|null $subject Subject(s)
     * @param PlainTextContent|null $plainTextContent Plain text version of
     *                                                    content
     * @param HtmlContent|null $htmlContent Html version of content
     * @param Substitution[]|null $globalSubstitutions Substitutions for entire
     *                                                    email
     */
    public function __construct(
        $from = null,
        $to = null,
        $subject = null,
        $plainTextContent = null,
        $htmlContent = null,
        array $globalSubstitutions = null
    ) {
        if (!isset($from)
            && !isset($to)
            && !isset($subject)
            && !isset($plainTextContent)
            && !isset($htmlContent)
            && !isset($globalSubstitutions)
        ) {
            $this->personalization[] = new Personalization();
            return;
        }
        if (isset($from)) {
            $this->setFrom($from);
        }
        if (isset($to)) {
            if (!is_array($to)) {
                $to = [$to];
            }
            $subjectCount = 0;
            $personalization = new Personalization();
            foreach ($to as $email) {
                if ($subs = $email->getSubstitutions()) {
                    $personalization = new Personalization();
                }
                $personalization->addTo($email);
                if ($subs = $email->getSubstitutions()) {
                    foreach ($subs as $key => $value) {
                        $personalization->addSubstitution($key, $value);
                    }
                }
                if ($email->getSubject()) {
                    $personalization->setSubject($email->getSubject());
                }
                if (is_array($subject)) {
                    if ($subjectCount < sizeof($subject)) {
                        $personalization->setSubject($subject[$subjectCount]);
                    }
                    $subjectCount++;
                }
                if (is_array($globalSubstitutions)) {
                    foreach ($globalSubstitutions as $key => $value) {
                        $personalization->addSubstitution($key, $value);
                    }
                }
                if ($subs = $email->getSubstitutions()) {
                    $this->addPersonalization($personalization);
                }
            }
            if (isset($email)) {
                if (!$subs = $email->getSubstitutions()) {
                    $this->addPersonalization($personalization);
                }
            }
        }
        if (isset($subject)) {
            if (!is_array($subject)) {
                $this->setSubject($subject);
            }
        }
        if (isset($plainTextContent)) {
            $this->addContent($plainTextContent);
        }
        if (isset($htmlContent)) {
            $this->addContent($htmlContent);
        }
    }

    /**
     * Adds a To, Cc or Bcc object to a Personalization object
     *
     * @param string $emailType Object type name:
     *                                                         To, Cc or Bcc
     * @param string $email Recipient email
     *                                                         address
     * @param string|null $name Recipient name
     * @param Substitution[]|array|null $substitutions Personalized
     *                                                         substitutions
     * @param int|null $personalizationIndex Index into an array
     *                                                         of existing
     *                                                         Personalization
     *                                                         objects
     * @param Personalization|null $personalization A pre-created
     *                                                         Personalization object
     *
     * @return null
     */
    private function addRecipientEmail(
        $emailType,
        $email,
        $name = null,
        $substitutions = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $personalizationFunctionCall = "add" . $emailType;
        $emailType = "\SendGrid\Mail\\" . $emailType;
        if (!($email instanceof $emailType)) {
            $email = new $emailType(
                $email,
                $name,
                $substitutions
            );
        }
        if ($personalization != null) {
            $personalization->$personalizationFunctionCall($email);
            if ($subs = $email->getSubstitutions()) {
                foreach ($subs as $key => $value) {
                    $personalization->addSubstitution($key, $value);
                }
            }
            $this->addPersonalization($personalization);
            return;
        } else {
            if (isset($personalizationIndex)
                && !isset($this->personalization[$personalizationIndex])
            ) {
                // TODO: We should only do this if there exists an index
                // previous. For example, if given an index 3 and there is
                // no index 2, we should throw an error.
                $this->personalization[$personalizationIndex]
                    = new Personalization();
            }
            if ($this->personalization[0] != null && $personalizationIndex == 0) {
                $this->personalization[0]->$personalizationFunctionCall($email);
                if ($subs = $email->getSubstitutions()) {
                    foreach ($subs as $key => $value) {
                        $this->personalization[0]->addSubstitution($key, $value);
                    }
                }
                return;
            } else if ($this->personalization[$personalizationIndex] != null) {
                $this->personalization[$personalizationIndex]->$personalizationFunctionCall($email);
                if ($subs = $email->getSubstitutions()) {
                    foreach ($subs as $key => $value) {
                        $this->personalization[$personalizationIndex]->addSubstitution(
                            $key,
                            $value
                        );
                    }
                }
                return;
            } else {
                $personalization = new Personalization();
                $personalization->$personalizationFunctionCall($email);
                if ($subs = $email->getSubstitutions()) {
                    foreach ($subs as $key => $value) {
                        $personalization->addSubstitution($key, $value);
                    }
                }
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

    /**
     * Adds an array of To, Cc or Bcc objects to a Personalization object
     *
     * @param string $emailType Object type name: To, Cc
     *                                                   or Bcc
     * @param To[]|Cc[]|Bcc[] $emails Array of email recipients
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A Personalization object
     */
    private function addRecipientEmails(
        $emailType,
        $emails,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $emailFunctionCall = "add" . $emailType;

        if (current($emails) instanceof EmailAddress) {
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

    /**
     * Add a Personalization object to the Mail object
     *
     * @param Personalization $personalization A Personalization object
     */
    public function addPersonalization($personalization)
    {
        $this->personalization[] = $personalization;
    }

    /**
     * Retrieve a Personalization object from the Mail object
     *
     * @return Personalization[]
     */
    public function getPersonalizations()
    {
        return $this->personalization;
    }

    /**
     * Retrieve the number of Personalization objects associated with the Mail object
     *
     * @return int
     */
    public function getPersonalizationCount()
    {
        return count($this->personalization);
    }

    /**
     * Adds an email recipient to a Personalization object
     *
     * @param string|To $to Email address or To object
     * @param string $name Recipient name
     * @param array|Substitution[] $substitutions Personalized substitutions
     * @param int|null $personalizationIndex Index into an array of
     *                                                    existing Personalization
     *                                                    objects
     * @param Personalization|null $personalization A pre-created
     *                                                    Personalization object
     */
    public function addTo(
        $to,
        $name = null,
        $substitutions = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if ($to instanceof To) {
            $name = $to->getName();
            $substitutions = $to->getSubstitutions();
            $to = $to->getEmailAddress();
        }
        $this->addRecipientEmail(
            "To",
            $to,
            $name,
            $substitutions,
            $personalizationIndex,
            $personalization
        );
    }

    /**
     * Adds multiple email recipients to a Personalization object
     *
     * @param To[]|array $toEmails Array of To objects or
     *                                                   key/value pairs of email
     *                                                   address/recipient names
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
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

    /**
     * Adds an email cc recipient to a Personalization object
     *
     * @param string|Cc $cc Email address or Cc object
     * @param string $name Recipient name
     * @param Substitution[]|array|null $substitutions Personalized
     *                                                         substitutions
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function addCc(
        $cc,
        $name = null,
        $substitutions = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if ($cc instanceof Cc) {
            $name = $cc->getName();
            $cc = $cc->getEmailAddress();
        }
        $this->addRecipientEmail(
            "Cc",
            $cc,
            $name,
            $substitutions,
            $personalizationIndex,
            $personalization
        );
    }

    /**
     * Adds multiple email cc recipients to a Personalization object
     *
     * @param Cc[]|array $ccEmails Array of Cc objects or
     *                                                   key/value pairs of email
     *                                                   address/recipient names
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
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

    /**
     * Adds an email bcc recipient to a Personalization object
     *
     * @param string|Bcc $bcc Email address or Bcc object
     * @param string $name Recipient name
     * @param Substitution[]|array|null $substitutions Personalized
     *                                                         substitutions
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function addBcc(
        $bcc,
        $name = null,
        $substitutions = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if ($bcc instanceof Bcc) {
            $name = $bcc->getName();
            $bcc = $bcc->getEmailAddress();
        }
        $this->addRecipientEmail(
            "Bcc",
            $bcc,
            $name,
            $substitutions,
            $personalizationIndex,
            $personalization
        );
    }

    /**
     * Adds multiple email bcc recipients to a Personalization object
     *
     * @param Bcc[]|array $bccEmails Array of Bcc objects or
     *                                                   key/value pairs of email
     *                                                   address/recipient names
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function addBccs(
        $bccEmails,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $this->addRecipientEmails(
            "Bcc",
            $bccEmails,
            $personalizationIndex,
            $personalization
        );
    }

    /**
     * Add a subject to a Personalization or Mail object
     *
     * If you don't provide a Personalization object or index, the
     * subject will be global to entire message. Note that
     * subjects added to Personalization objects override
     * global subjects.
     *
     * @param string|Subject $subject Email subject
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function setSubject(
        $subject,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if (!($subject instanceof Subject)) {
            $subject = new Subject($subject);
        }

        if ($personalization != null) {
            $personalization->setSubject($subject);
            $this->addPersonalization($personalization);
            return;
        }
        if ($personalizationIndex != null) {
            $this->personalization[$personalizationIndex]->setSubject($subject);
            return;
        }
        $this->setGlobalSubject($subject);
        return;
    }

    /**
     * Retrieve a subject attached to a Personalization object
     *
     * @param int|0 $personalizationIndex Index into an array of
     *                                    existing Personalization
     *                                    objects
     *
     * @return Subject
     */
    public function getSubject($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getSubject();
    }

    /**
     * Add a header to a Personalization or Mail object
     *
     * If you don't provide a Personalization object or index, the
     * header will be global to entire message. Note that
     * headers added to Personalization objects override
     * global headers.
     *
     * @param string|Header $key Key or Header object
     * @param string|null $value Value
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function addHeader(
        $key,
        $value = null,
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
            } else if ($this->personalization[$personalizationIndex] != null) {
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

    /**
     * Adds multiple headers to a Personalization or Mail object
     *
     * If you don't provide a Personalization object or index, the
     * header will be global to entire message. Note that
     * headers added to Personalization objects override
     * global headers.
     *
     * @param array|Header[] $headers Array of Header objects
     *                                                   or key values
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function addHeaders(
        $headers,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if (current($headers) instanceof Header) {
            foreach ($headers as $header) {
                $this->addHeader($header);
            }
        } else {
            foreach ($headers as $key => $value) {
                $this->addHeader(
                    $key,
                    $value,
                    $personalizationIndex,
                    $personalization
                );
            }
        }
    }

    /**
     * Retrieve the headers attached to a Personalization object
     *
     * @param int|0 $personalizationIndex Index into an array of
     *                                    existing Personalization
     *                                    objects
     *
     * @return Header[]
     */
    public function getHeaders($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getHeaders();
    }

    /**
     * Add a DynamicTemplateData object or key/value to a Personalization object
     *
     * @param DynamicTemplateData|string $data DynamicTemplateData object or the key of a
     *                                         dynamic data
     * @param string|null $value Value
     * @param int|null $personalizationIndex Index into an array of
     *                                       existing Personalization
     *                                       objects
     * @param Personalization|null $personalization A pre-created
     *                                              Personalization object
     */
    public function addDynamicTemplateData(
        $key,
        $value = null,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $this->addSubstitution($key, $value, $personalizationIndex, $personalization);
    }

    /**
     * Add a DynamicTemplateData object or key/value to a Personalization object
     *
     * @param array|DynamicTemplateData[] $data Array of DynamicTemplateData objects or key/values
     * @param int|null $personalizationIndex Index into an array of
     *                                       existing Personalization
     *                                       objects
     * @param Personalization|null $personalization A pre-created
     *                                              Personalization object
     */
    public function addDynamicTemplateDatas(
        $datas,
        $personalizationIndex = null,
        $personalization = null
    ) {
        $this->addSubstitutions($datas);
    }

    /**
     * Retrieve dynamic template data key/value pairs from a Personalization object
     *
     * @param int|0 $personalizationIndex Index into an array of
     *                                    existing Personalization
     *                                    objects
     *
     * @return array
     */
    public function getDynamicTemplateDatas($personalizationIndex = 0)
    {
        return $this->getSubstitutions($personalizationIndex);
    }

    /**
     * Add a substitution to a Personalization or Mail object
     *
     * If you don't provide a Personalization object or index, the
     * substitution will be global to entire message. Note that
     * substitutions added to Personalization objects override
     * global substitutions.
     *
     * @param string|Substitution $key Key or Substitution object
     * @param string|null $value Value
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     *
     * @return null
     */
    public function addSubstitution(
        $key,
        $value = null,
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
            } else if ($this->personalization[$personalizationIndex] != null) {
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

    /**
     * Adds multiple substitutions to a Personalization or Mail object
     *
     * If you don't provide a Personalization object or index, the
     * substitution will be global to entire message. Note that
     * substitutions added to Personalization objects override
     * global headers.
     *
     * @param array|Substitution[] $substitutions Array of Substitution
     *                                            objects or key/values
     * @param int|null $personalizationIndex Index into an array of
     *                                       existing Personalization
     *                                       objects
     * @param Personalization|null $personalization A pre-created
     *                                              ersonalization object
     */
    public function addSubstitutions(
        $substitutions,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if (current($substitutions) instanceof Substitution) {
            foreach ($substitutions as $substitution) {
                $this->addSubstitution($substitution);
            }
        } else {
            foreach ($substitutions as $key => $value) {
                $this->addSubstitution(
                    $key,
                    $value,
                    $personalizationIndex,
                    $personalization
                );
            }
        }
    }

    /**
     * Retrieve the substitutions attached to a Personalization object
     *
     * @param int|0 $personalizationIndex Index into an array of
     *                                    existing Personalization
     *                                    objects
     *
     * @return Substitution[]
     */
    public function getSubstitutions($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getSubstitutions();
    }

    /**
     * Add a custom arg to a Personalization or Mail object
     *
     * Note that custom args added to Personalization objects
     * override global custom args.
     *
     * @param string|CustomArg $key Key or CustomArg object
     * @param string|null $value Value
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function addCustomArg(
        $key,
        $value = null,
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
            } else if ($this->personalization[$personalizationIndex] != null) {
                $this->personalization[$personalizationIndex]->addCustomArg(
                    $custom_arg
                );
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

    /**
     * Adds multiple custom args to a Personalization or Mail object
     *
     * If you don't provide a Personalization object or index, the
     * custom arg will be global to entire message. Note that
     * custom args added to Personalization objects override
     * global custom args.
     *
     * @param array|CustomArg[] $custom_args Array of CustomArg objects
     *                                                   or key/values
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function addCustomArgs(
        $custom_args,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if (current($custom_args) instanceof CustomArg) {
            foreach ($custom_args as $custom_arg) {
                $this->addCustomArg($custom_arg);
            }
        } else {
            foreach ($custom_args as $key => $value) {
                $this->addCustomArg(
                    $key,
                    $value,
                    $personalizationIndex,
                    $personalization
                );
            }
        }
    }

    /**
     * Retrieve the custom args attached to a Personalization object
     *
     * @param int|0 $personalizationIndex Index into an array of
     *                                    existing Personalization
     *                                    objects
     *
     * @return CustomArg[]
     */
    public function getCustomArgs($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getCustomArgs();
    }

    /**
     * Add a unix timestamp allowing you to specify when you want your
     * email to be delivered to a Personalization or Mail object
     *
     * If you don't provide a Personalization object or index, the
     * send at timestamp will be global to entire message. Note that
     * timestamps added to Personalization objects override
     * global timestamps.
     *
     * @param int|SendAt $send_at A unix timestamp
     * @param int|null $personalizationIndex Index into an array of
     *                                                   existing Personalization
     *                                                   objects
     * @param Personalization|null $personalization A pre-created
     *                                                   Personalization object
     */
    public function setSendAt(
        $send_at,
        $personalizationIndex = null,
        $personalization = null
    ) {
        if (!($send_at instanceof SendAt)) {
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
            } else if ($this->personalization[$personalizationIndex] != null) {
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

    /**
     * Retrieve the unix timestamp attached to a Personalization object
     *
     * @param int|0 $personalizationIndex Index into an array of
     *                                    existing Personalization
     *                                    objects
     *
     * @return SendAt
     */
    public function getSendAt($personalizationIndex = 0)
    {
        return $this->personalization[$personalizationIndex]->getSendAt();
    }

    /**
     * Add the sender email address to a Mail object
     *
     * @param string|From $email Email address or From object
     * @param string|null $name  Sender name
     *
     * @throws TypeException
     */
    public function setFrom($email, $name = null)
    {
        if ($email instanceof From) {
            $this->from = $email;
        } else {

            if (
                is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL)
            ) {
                $this->from = new From($email, $name);
            } else {
                throw new TypeException(
                    '$email must be valid and of type string.'
                );
            }

        }
        return;
    }

    /**
     * Retrieve the sender attached to a Mail object
     *
     * @return From
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Add the reply to email address to a Mail object
     *
     * @param string|ReplyTo $email Email address or From object
     * @param string|null $name Reply to name
     */
    public function setReplyTo($email, $name = null)
    {
        if ($email instanceof ReplyTo) {
            $this->reply_to = $email;
        } else {
            $this->reply_to = new ReplyTo($email, $name);
        }
    }

    /**
     * Retrieve the reply to information attached to a Mail object
     *
     * @return ReplyTo
     */
    public function getReplyTo()
    {
        return $this->reply_to;
    }


    /**
     * Add a subject to a Mail object
     *
     * Note that
     * subjects added to Personalization objects override
     * global subjects.
     *
     * @param string|Subject $subject Email subject
     */
    public function setGlobalSubject($subject)
    {
        if (!($subject instanceof Subject)) {
            $subject = new Subject($subject);
        }
        $this->subject = $subject;
    }

    /**
     * Retrieve a subject attached to a Mail object
     *
     * @return Subject
     */
    public function getGlobalSubject()
    {
        return $this->subject;
    }

    /**
     * Add content to a Mail object
     *
     * For a list of pre-configured mime types, please see
     * MimeType.php
     *
     * @param string|Content $type Mime type or Content object
     * @param string|null $value Contents (e.g. text or html)
     */
    public function addContent($type, $value = null)
    {
        if ($type instanceof Content) {
            $content = $type;
        } else {
            $content = new Content($type, $value);
        }
        $this->contents[] = $content;
    }

    /**
     * Adds multiple Content objects to a Mail object
     *
     * @param array|Content[] $contents Array of Content objects
     *                                  or key value pairs
     */
    public function addContents($contents)
    {
        if (current($contents) instanceof Content) {
            foreach ($contents as $content) {
                $this->addContent($content);
            }
        } else {
            foreach ($contents as $key => $value) {
                $this->addContent($key, $value);
            }
        }
    }

    /**
     * Retrieve the contents attached to a Mail object
     *
     * Will return array of Content Objects with text/plain MimeType first
     * Array re-ordered before return where this is not already the case
     *
     * @return Content[]
     */
    public function getContents()
    {
        if ($this->contents) {
            if ($this->contents[0]->getType() !== 'text/plain'
            && count($this->contents) > 1
            ) {
                foreach ($this->contents as $key => $value) {
                    if ($value->getType() == 'text/plain') {
                        $plain_content = $value;
                        unset($this->contents[$key]);
                        break;
                    }
                }
                if (isset($plain_content)) {
                    array_unshift($this->contents, $plain_content);
                }
            }
        }

        return $this->contents;
    }

    /**
     * Add an attachment to a Mail object
     *
     * @param string|Attachment $attachment Attachment object or
     *                                       Base64 encoded content
     * @param string|null $type Mime type of the attachment
     * @param string|null $filename File name of the attachment
     * @param string|null $disposition How the attachment should be
     *                                       displayed: inline or attachment
     *                                       default is attachment
     * @param string|null $content_id Used when disposition is inline
     *                                       to diplay the file within the
     *                                       body of the email
     */
    public function addAttachment(
        $attachment,
        $type = null,
        $filename = null,
        $disposition = null,
        $content_id = null
    ) {
        if (is_array($attachment)) {
            $attachment = new Attachment(
                $attachment[0],
                $attachment[1],
                $attachment[2],
                $attachment[3],
                $attachment[4]
            );
        } else if (!($attachment instanceof Attachment)) {
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

    /**
     * Adds multiple attachments to a Mail object
     *
     * @param array|Attachment[] $attachments Array of Attachment objects
     *                                         or arrays
     */
    public function addAttachments($attachments)
    {
        foreach ($attachments as $attachment) {
            $this->addAttachment($attachment);
        }
    }

    /**
     * Retrieve the attachments attached to a Mail object
     *
     * @return Attachment[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Add a template id to a Mail object
     *
     * @param string $template_id The id of the template to be
     *                            appied to this email
     */
    public function setTemplateId($template_id)
    {
        if (!($template_id instanceof TemplateId)) {
            $template_id = new TemplateId($template_id);
        }

        $this->template_id = $template_id;
    }

    /**
     * Retrieve a template id attached to a Mail object
     *
     * @return TemplateId
     */
    public function getTemplateId()
    {
        return $this->template_id;
    }

    /**
     * Add a section to a Mail object
     *
     * @param string|Section $key Key or Section object
     * @param string|null $value Value
     */
    public function addSection($key, $value = null)
    {
        if ($key instanceof Section) {
            $section = $key;
            $this->sections[$section->getKey()]
                = $section->getValue();
            return;
        }
        $this->sections[$key] = (string)$value;
    }

    /**
     * Adds multiple sections to a Mail object
     *
     * @param array|Section[] $sections Array of CustomArg objects
     *                                  or key/values
     */
    public function addSections($sections)
    {
        if (current($sections) instanceof Section) {
            foreach ($sections as $section) {
                $this->addSection($section);
            }
        } else {
            foreach ($sections as $key => $value) {
                $this->addSection($key, $value);
            }
        }
    }

    /**
     * Retrieve the section(s) attached to a Mail object
     *
     * @return Section[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Add a header to a Mail object
     *
     * Note that headers added to Personalization objects override
     * global headers.
     *
     * @param string|Header $key Key or Header object
     * @param string|null $value Value
     */
    public function addGlobalHeader($key, $value = null)
    {
        if ($key instanceof Header) {
            $header = $key;
            $this->headers[$header->getKey()]
                = $header->getValue();
            return;
        }
        $this->headers[$key] = (string)$value;
    }

    /**
     * Adds multiple headers to a Mail object
     *
     * Note that headers added to Personalization objects override
     * global headers.
     *
     * @param array|Header[] $headers Array of Header objects
     *                                or key values
     */
    public function addGlobalHeaders($headers)
    {
        if (current($headers) instanceof Header) {
            foreach ($headers as $header) {
                $this->addGlobalHeader($header);
            }
        } else {
            foreach ($headers as $key => $value) {
                $this->addGlobalHeader($key, $value);
            }
        }
    }

    /**
     * Retrieve the headers attached to a Mail object
     *
     * @return Header[]
     */
    public function getGlobalHeaders()
    {
        return $this->headers;
    }

    /**
     * Add a substitution to a Mail object
     *
     * Note that substitutions added to Personalization objects override
     * global substitutions.
     *
     * @param string|Substitution $key Key or Substitution object
     * @param string|null $value Value
     */
    public function addGlobalSubstitution($key, $value = null)
    {
        if ($key instanceof Substitution) {
            $substitution = $key;
            $this->substitutions[$substitution->getKey()]
                = $substitution->getValue();
            return;
        }
        $this->substitutions[$key] = $value;
    }

    /**
     * Adds multiple substitutions to a Mail object
     *
     * Note that substitutions added to Personalization objects override
     * global headers.
     *
     * @param array|Substitution[] $substitutions Array of Substitution
     *                                            objects or key/values
     */
    public function addGlobalSubstitutions($substitutions)
    {
        if (current($substitutions) instanceof Substitution) {
            foreach ($substitutions as $substitution) {
                $this->addGlobalSubstitution($substitution);
            }
        } else {
            foreach ($substitutions as $key => $value) {
                $this->addGlobalSubstitution($key, $value);
            }
        }
    }

    /**
     * Retrieve the substitutions attached to a Mail object
     *
     * @return Substitution[]
     */
    public function getGlobalSubstitutions()
    {
        return $this->substitutions;
    }

    /**
     * Add a category to a Mail object
     *
     * @param string|Category $category Category object or category name
     */
    public function addCategory($category)
    {
        if (!($category instanceof Category)) {
            $category = new Category($category);
        }
        $this->categories[] = $category;
    }

    /**
     * Adds multiple categories to a Mail object
     *
     * @param array|Category[] $categories Array of Category objects
     *                                     or arrays
     */
    public function addCategories($categories)
    {
        foreach ($categories as $category) {
            $this->addCategory($category);
        }
        return;
    }

    /**
     * Retrieve the categories attached to a Mail object
     *
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add a custom arg to a Mail object
     *
     * Note that custom args added to Personalization objects override
     * global custom args.
     *
     * @param string|CustomArg $key Key or CustomArg object
     * @param string|null $value Value
     */
    public function addGlobalCustomArg($key, $value = null)
    {
        if ($key instanceof CustomArg) {
            $custom_arg = $key;
            $this->custom_args[$custom_arg->getKey()]
                = $custom_arg->getValue();
            return;
        }
        $this->custom_args[$key] = (string)$value;
    }

    /**
     * Adds multiple custom args to a Mail object
     *
     * Note that custom args added to Personalization objects override
     * global custom args.
     *
     * @param array|CustomArg[] $custom_args Array of CustomArg objects
     *                                       or key/values
     */
    public function addGlobalCustomArgs($custom_args)
    {
        if (current($custom_args) instanceof CustomArg) {
            foreach ($custom_args as $custom_arg) {
                $this->addGlobalCustomArg($custom_arg);
            }
        } else {
            foreach ($custom_args as $key => $value) {
                $this->addGlobalCustomArg($key, $value);
            }
        }
    }

    /**
     * Retrieve the custom args attached to a Mail object
     *
     * @return CustomArg[]
     */
    public function getGlobalCustomArgs()
    {
        return $this->custom_args;
    }

    /**
     * Add a unix timestamp allowing you to specify when you want your
     * email to be delivered to a Mail object
     *
     * Note that timestamps added to Personalization objects override
     * global timestamps.
     *
     * @param int|SendAt $send_at A unix timestamp
     */
    public function setGlobalSendAt($send_at)
    {
        if (!($send_at instanceof SendAt)) {
            $send_at = new SendAt($send_at);
        }
        $this->send_at = $send_at;
    }

    /**
     * Retrieve the unix timestamp attached to a Mail object
     *
     * @return SendAt
     */
    public function getGlobalSendAt()
    {
        return $this->send_at;
    }

    /**
     * Add a batch id to a Mail object
     *
     * @param string|BatchId $batch_id Id for a batch of emails
     *                                 to be sent at the same time
     */
    public function setBatchId($batch_id)
    {
        if (!($batch_id instanceof BatchId)) {
            $batch_id = new BatchId($batch_id);
        }
        $this->batch_id = $batch_id;
    }

    /**
     * Retrieve the batch id attached to a Mail object
     *
     * @return BatchId
     */
    public function getBatchId()
    {
        return $this->batch_id;
    }

    /**
     * Add a Asm describing how to handle unsubscribes to a Mail object
     *
     * @param int|Asm $group_id Asm object or unsubscribe group id
     *                                   to associate this email with
     * @param array $groups_to_display Array of integer ids of unsubscribe
     *                                   groups to be displayed on the
     *                                   unsubscribe preferences page
     */
    public function setAsm($group_id, $groups_to_display = null)
    {
        if ($group_id instanceof Asm) {
            $asm = $group_id;
            $this->asm = $asm;
        } else {
            $this->asm = new Asm($group_id, $groups_to_display);
        }
    }

    /**
     * Retrieve the Asm object describing how to handle unsubscribes attached
     * to a Mail object
     *
     * @return Asm
     */
    public function getAsm()
    {
        return $this->asm;
    }

    /**
     * Add the IP pool name to a Mail object
     *
     * @param string|IpPoolName $ip_pool_name The IP Pool that you would
     *                                        like to send this email from
     */
    public function setIpPoolName($ip_pool_name)
    {
        if ($ip_pool_name instanceof IpPoolName) {
            $this->ip_pool_name = $ip_pool_name->getIpPoolName();
        } else {
            $this->ip_pool_name = new IpPoolName($ip_pool_name);
        }

    }

    /**
     * Retrieve the IP pool name attached to a Mail object
     *
     * @return IpPoolName
     */
    public function getIpPoolName()
    {
        return $this->ip_pool_name;
    }

    /**
     * Add a MailSettings object to a Mail object
     *
     * @param MailSettings $mail_settings A collection of different
     *                                    mail settings that you can
     *                                    use to specify how you would
     *                                    like this email to be handled
     * @throws TypeException
     */
    public function setMailSettings($mail_settings)
    {
        if (!($mail_settings instanceof MailSettings)) {
            throw new TypeException(
                '$mail_settings must be an instance of SendGrid\Mail\MailSettings'
            );
        }
        $this->mail_settings = $mail_settings;
    }

    /**
     * Retrieve the MailSettings object attached to a Mail object
     *
     * @return MailSettings
     */
    public function getMailSettings()
    {
        return $this->mail_settings;
    }

    /**
     * Set the Bcc settings on a MailSettings object
     *
     * @param bool|BccSettings $enable A BccSettings object or a boolean
     *                                 to determine if this setting is active
     * @param string|null $email The email address to be bcc'ed
     */
    public function setBccSettings($enable, $email = null)
    {
        if (!($this->mail_settings instanceof MailSettings)) {
            $this->mail_settings = new MailSettings();
        }
        $this->mail_settings->setBccSettings($enable, $email);
    }

    /**
     * Enable bypass list management on a MailSettings object
     *
     * Allows you to bypass all unsubscribe groups and suppressions to ensure
     * that the email is delivered to every single recipient. This should only
     * be used in emergencies when it is absolutely necessary that every
     * recipient receives your email.
     */
    public function enableBypassListManagement()
    {
        if (!$this->mail_settings instanceof MailSettings) {
            $this->mail_settings = new MailSettings();
        }
        $this->mail_settings->setBypassListManagement(true);
    }

    /**
     * Disable bypass list management on a MailSettings object
     *
     * Allows you to bypass all unsubscribe groups and suppressions to ensure
     * that the email is delivered to every single recipient. This should only
     * be used in emergencies when it is absolutely necessary that every
     * recipient receives your email.
     */
    public function disableBypassListManagement()
    {
        if (!($this->mail_settings instanceof MailSettings)) {
            $this->mail_settings = new MailSettings();
        }
        $this->mail_settings->setBypassListManagement(false);
    }

    /**
     * Set the Footer settings on a MailSettings object
     *
     * @param bool|Footer $enable A Footer object or a boolean
     *                            to determine if this setting is active
     * @param string|null $text The plain text content of the footer
     * @param string|null $html The HTML content of the footer
     */
    public function setFooter($enable = null, $text = null, $html = null)
    {
        if (!$this->mail_settings instanceof MailSettings) {
            $this->mail_settings = new MailSettings();
        }
        $this->mail_settings->setFooter($enable, $text, $html);
    }

    /**
     * Enable sandbox mode on a MailSettings object
     *
     * This allows you to send a test email to ensure that your request
     * body is valid and formatted correctly.
     */
    public function enableSandBoxMode()
    {
        if (!($this->mail_settings instanceof MailSettings)) {
            $this->mail_settings = new MailSettings();
        }
        $this->mail_settings->setSandBoxMode(true);
    }

    /**
     * Disable sandbox mode on a MailSettings object
     *
     * This allows you to send a test email to ensure that your request
     * body is valid and formatted correctly.
     */
    public function disableSandBoxMode()
    {
        if (!($this->mail_settings instanceof MailSettings)) {
            $this->mail_settings = new MailSettings();
        }
        $this->mail_settings->setSandBoxMode(false);
    }

    /**
     * Set the spam check settings on a MailSettings object
     *
     * @param bool|SpamCheck $enable A SpamCheck object or a boolean
     *                                    to determine if this setting is active
     * @param int|null $threshold The threshold used to determine if your
     *                                    content qualifies as spam on a scale from
     *                                    1 to 10, with 10 being most strict, or
     *                                    most likely to be considered as spam
     * @param string|null $post_to_url An Inbound Parse URL that you would like
     *                                    a copy of your email along with the spam
     *                                    report to be sent to
     */
    public function setSpamCheck($enable = null, $threshold = null, $post_to_url = null)
    {
        if (!$this->mail_settings instanceof MailSettings) {
            $this->mail_settings = new MailSettings();
        }
        $this->mail_settings->setSpamCheck($enable, $threshold, $post_to_url);
    }

    /**
     * Add a TrackingSettings object to a Mail object
     *
     * @param TrackingSettings $tracking_settings Settings to determine how you
     *                                            would like to track the metrics
     *                                            of how your recipients interact
     *                                            with your email
     * @throws TypeException
     */
    public function setTrackingSettings($tracking_settings)
    {
        if (!($tracking_settings instanceof TrackingSettings)) {
            throw new TypeException(
                '$tracking_settings must be an instance of SendGrid\Mail\TrackingSettings'
            );
        }
        $this->tracking_settings = $tracking_settings;
    }

    /**
     * Retrieve the TrackingSettings object attached to a Mail object
     *
     * @return TrackingSettings
     */
    public function getTrackingSettings()
    {
        return $this->tracking_settings;
    }

    /**
     * Set the click tracking settings on a TrackingSettings object
     *
     * @param bool|ClickTracking $enable A ClickTracking object or a boolean
     *                                        to determine if this setting is active
     * @param bool|null $enable_text Indicates if this setting should be
     *                                        included in the text/plain portion of
     *                                        your email
     */
    public function setClickTracking($enable = null, $enable_text = null)
    {
        if (!($this->tracking_settings instanceof TrackingSettings)) {
            $this->tracking_settings = new TrackingSettings();
        }
        $this->tracking_settings->setClickTracking($enable, $enable_text);
    }

    /**
     * Set the open tracking settings on a TrackingSettings object
     *
     * @param bool|OpenTracking $enable A OpenTracking object or a boolean
     *                                            to determine if this setting is
     *                                            active
     * @param string|null $substitution_tag Allows you to specify a
     *                                            substitution tag that you can
     *                                            insert in the body of your email
     *                                            at a location that you desire.
     *                                            This tag will be replaced by the
     *                                            open tracking pixel
     */
    public function setOpenTracking($enable = null, $substitution_tag = null)
    {
        if (!($this->tracking_settings instanceof TrackingSettings)) {
            $this->tracking_settings = new TrackingSettings();
        }
        $this->tracking_settings->setOpenTracking($enable, $substitution_tag);
    }

    /**
     * Set the subscription tracking settings on a TrackingSettings object
     *
     * @param bool|SubscriptionTracking $enable A SubscriptionTracking
     *                                                    object or a boolean to
     *                                                    determine if this setting
     *                                                    is active
     * @param string|null $text Text to be appended to the
     *                                                    email, with the
     *                                                    subscription tracking
     *                                                    link. You may control
     *                                                    where the link is by using
     *                                                    the tag <% %>
     * @param string|null $html HTML to be appended to the
     *                                                    email, with the
     *                                                    subscription tracking
     *                                                    link. You may control
     *                                                    where the link is by using
     *                                                    the tag <% %>
     * @param string|null $substitution_tag A tag that will be
     *                                                    replaced with the
     *                                                    unsubscribe URL. for
     *                                                    example:
     *                                                    [unsubscribe_url]. If this
     *                                                    parameter is used, it will
     *                                                    override both the text and
     *                                                    html parameters. The URL
     *                                                    of the link will be placed
     *                                                    at the substitution tag’s
     *                                                    location, with no
     *                                                    additional formatting
     */
    public function setSubscriptionTracking(
        $enable = null,
        $text = null,
        $html = null,
        $substitution_tag = null
    ) {
        if (!($this->tracking_settings instanceof TrackingSettings)) {
            $this->tracking_settings = new TrackingSettings();
        }
        $this->tracking_settings->setSubscriptionTracking(
            $enable,
            $text,
            $html,
            $substitution_tag
        );
    }

    /**
     * Set the Google anatlyics settings on a TrackingSettings object
     *
     * @param bool|Ganalytics $enable A Ganalytics object or a boolean to
     *                                      determine if this setting
     *                                      is active
     * @param string|null $utm_source Name of the referrer source. (e.g.
     *                                      Google, SomeDomain.com, or
     *                                      Marketing Email)
     * @param string|null $utm_medium Name of the marketing medium.
     *                                      (e.g. Email)
     * @param string|null $utm_term Used to identify any paid keywords.
     * @param string|null $utm_content Used to differentiate your campaign
     *                                      from advertisements
     * @param string|null $utm_campaign The name of the campaign
     */
    public function setGanalytics(
        $enable = null,
        $utm_source = null,
        $utm_medium = null,
        $utm_term = null,
        $utm_content = null,
        $utm_campaign = null
    ) {
        if (!($this->tracking_settings instanceof TrackingSettings)) {
            $this->tracking_settings = new TrackingSettings();
        }
        $this->tracking_settings->setGanalytics(
            $enable,
            $utm_source,
            $utm_medium,
            $utm_term,
            $utm_content,
            $utm_campaign
        );
    }

    /**
     * Return an array representing a request object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        // Detect if we are using the new dynamic templates
        $template_id = $this->getTemplateId();
        if ($template_id != null) {
            if (substr((string) $template_id->getTemplateId(), 0, 2) == "d-") {
                foreach ($this->personalization as $personalization) {
                    $personalization->setHasDynamicTemplate(true);
                }
            }
        }

        return array_filter(
            [
                'personalizations' => array_values(array_filter(
                    $this->getPersonalizations(),
                    function ($value) {
                        return null !== $value && null !== $value->jsonSerialize();
                    }
                )),
                'from' => $this->getFrom(),
                'reply_to' => $this->getReplyTo(),
                'subject' => $this->getGlobalSubject(),
                'content' => $this->getContents(),
                'attachments' => $this->getAttachments(),
                'template_id' => $this->getTemplateId(),
                'sections' => $this->getSections(),
                'headers' => $this->getGlobalHeaders(),
                'categories' => $this->getCategories(),
                'custom_args' => $this->getGlobalCustomArgs(),
                'send_at' => $this->getGlobalSendAt(),
                'batch_id' => $this->getBatchId(),
                'asm' => $this->getASM(),
                'ip_pool_name' => $this->getIpPoolName(),
                'substitutions' => $this->getGlobalSubstitutions(),
                'mail_settings' => $this->getMailSettings(),
                'tracking_settings' => $this->getTrackingSettings()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
