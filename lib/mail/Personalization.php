<?php
/**
 * This helper builds the Personalization object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a Personalization object for
 * the /mail/send API call
 *
 * Each Personalization can be thought of as an envelope - it defines
 * who should receive an individual message and how that message should be handled
 *
 * @package SendGrid\Mail
 */
class Personalization implements \JsonSerializable
{
    /** @var $tos To[] objects */
    private $tos;
    /** @var $from From object */
    private $from;
    /** @var $ccs Cc[] objects */
    private $ccs;
    /** @var $bccs Bcc[] objects */
    private $bccs;
    /** @var $subject Subject object */
    private $subject;
    /** @var $headers Header[] array of header key values */
    private $headers;
    /** @var $substitutions Substitution[] array of substitution key values, used for legacy templates */
    private $substitutions;
    /** @var array of dynamic template data key values */
    private $dynamic_template_data;
    /** @var bool if we are using dynamic templates this will be true */
    private $has_dynamic_template = false;
    /** @var $custom_args CustomArg[] array of custom arg key values */
    private $custom_args;
    /** @var $send_at SendAt object */
    private $send_at;

    /**
     * Add a To object to a Personalization object
     *
     * @param To $email To object
     */
    public function addTo($email)
    {
        $this->tos[] = $email;
    }

    /**
     * Retrieve To object(s) from a Personalization object
     *
     * @return To[]
     */
    public function getTos()
    {
        return $this->tos;
    }

    /**
     * Add a From object to a Personalization object
     *
     * @param From $email From object
     */
    public function addFrom($email)
    {
        $this->from = $email;
    }

    /**
     * Retrieve From object from a Personalization object
     *
     * @return From|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Add a Cc object to a Personalization object
     *
     * @param Cc $email Cc object
     */
    public function addCc($email)
    {
        $this->ccs[] = $email;
    }

    /**
     * Retrieve Cc object(s) from a Personalization object
     *
     * @return Cc[]
     */
    public function getCcs()
    {
        return $this->ccs;
    }

    /**
     * Add a Bcc object to a Personalization object
     *
     * @param Bcc $email Bcc object
     */
    public function addBcc($email)
    {
        $this->bccs[] = $email;
    }

    /**
     * Retrieve Bcc object(s) from a Personalization object
     *
     * @return Bcc[]
     */
    public function getBccs()
    {
        return $this->bccs;
    }

    /**
     * Add a subject object to a Personalization object
     *
     * @param Subject|string $subject Subject object or string
     *
     * @throws TypeException
     */
    public function setSubject($subject)
    {
        if (!($subject instanceof Subject)) {
            Assert::string($subject, 'subject', '"$subject" must be an instance of SendGrid\Mail\Subject or a string');

            $subject = new Subject($subject);
        }
        $this->subject = $subject;
    }

    /**
     * Retrieve a Subject object from a Personalization object
     *
     * @return Subject|null
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Add a Header object to a Personalization object
     *
     * @param Header $header Header object
     */
    public function addHeader($header)
    {
        Assert::isInstanceOf($header, 'header', Header::class);

        $this->headers[$header->getKey()] = $header->getValue();
    }

    /**
     * Retrieve header key/value pairs from a Personalization object
     *
     * @return array|null
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Add a Substitution object or key/value to a Personalization object
     *
     * @param Substitution|string $data DynamicTemplateData object or the key of a
     *                                  dynamic data
     * @param string|null $value The value of dynamic data
     *
     * @throws TypeException
     */
    public function addDynamicTemplateData($data, $value = null)
    {
        $this->addSubstitution($data, $value);
    }

    /**
     * Retrieve dynamic template data key/value pairs from a Personalization object
     *
     * @return array|null
     */
    public function getDynamicTemplateData()
    {
        return $this->getSubstitutions();
    }

    /**
     * Add a Substitution object or key/value to a Personalization object
     *
     * @param Substitution|string $substitution Substitution object or the key of a
     *                                          substitution
     * @param string|null $value The value of a substitution
     *
     * @throws TypeException
     */
    public function addSubstitution($substitution, $value = null)
    {
        if (!($substitution instanceof Substitution)) {
            $key = $substitution;
            $substitution = new Substitution($key, $value);
        }
        $this->substitutions[$substitution->getKey()] = $substitution->getValue();
    }

    /**
     * Retrieve substitution key/value pairs from a Personalization object
     *
     * @return array|null
     */
    public function getSubstitutions()
    {
        return $this->substitutions;
    }

    /**
     * Add a CustomArg object to a Personalization object
     *
     * @param CustomArg $custom_arg CustomArg object
     *
     * @throws TypeException
     */
    public function addCustomArg($custom_arg)
    {
        Assert::isInstanceOf($custom_arg, 'custom_arg', CustomArg::class);

        $this->custom_args[$custom_arg->getKey()] = (string)$custom_arg->getValue();
    }

    /**
     * Retrieve custom arg key/value pairs from a Personalization object
     *
     * @return array|null
     */
    public function getCustomArgs()
    {
        return $this->custom_args;
    }

    /**
     * Add a SendAt object to a Personalization object
     *
     * @param SendAt $send_at SendAt object
     *
     * @throws TypeException
     */
    public function setSendAt($send_at)
    {
        Assert::isInstanceOf($send_at, 'send_at', SendAt::class);

        $this->send_at = $send_at;
    }

    /**
     * Retrieve a SendAt object from a Personalization object
     *
     * @return SendAt|null
     */
    public function getSendAt()
    {
        return $this->send_at;
    }

    /**
     * Specify if this personalization is using dynamic templates
     *
     * @param bool $has_dynamic_template are we using dynamic templates
     *
     * @throws TypeException
     */
    public function setHasDynamicTemplate($has_dynamic_template)
    {
        Assert::boolean($has_dynamic_template, 'has_dynamic_template');

        $this->has_dynamic_template = $has_dynamic_template;
    }

    /**
     * Determine if this Personalization object is using dynamic templates
     *
     * @return bool
     */
    public function getHasDynamicTemplate()
    {
        return $this->has_dynamic_template;
    }

    /**
     * Return an array representing a Personalization object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        if ($this->getHasDynamicTemplate()) {
            $dynamic_substitutions = $this->getSubstitutions();
            $substitutions = null;
        } else {
            $substitutions = $this->getSubstitutions();
            $dynamic_substitutions = null;
        }

        return array_filter(
            [
                'to' => $this->getTos(),
                'from' => $this->getFrom(),
                'cc' => $this->getCcs(),
                'bcc' => $this->getBccs(),
                'subject' => $this->getSubject(),
                'headers' => $this->getHeaders(),
                'substitutions' => $substitutions,
                'dynamic_template_data' => $dynamic_substitutions,
                'custom_args' => $this->getCustomArgs(),
                'send_at' => $this->getSendAt()
            ],
            static function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
