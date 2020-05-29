<?php
/**
 * This helper builds the Personalization object for a /mail/send API call
 */

namespace SendGrid\Mail;

use InvalidArgumentException;


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
    /** @var $ccs Cc[] objects */
    private $ccs;
    /** @var $bccs Bcc[] objects */
    private $bccs;
    /** @var $subject Subject object */
    private $subject;
    /** @var $headers Header[] array of header key values */
    private $headers;
    /** @var $substitutions array array of substitution key values, used for legacy templates */
    private $substitutions;
    /** @var array of dynamic template data key values */
    private $dynamic_template_data;
    /** @var bool if we are using dynamic templates this will be true */
    private $has_dynamic_template;
    /** @var $custom_args array array of custom arg key values */
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
     * @param Subject $subject Subject object
     *
     * @throws TypeException
     */
    public function setSubject($subject)
    {
        if (!($subject instanceof Subject)) {
            throw new TypeException(
                '$subject must be an instance of SendGrid\Mail\Subject'
            );
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
     */
    public function addCustomArg($custom_arg)
    {
        //  Not provided a CustomArg instance? Reject
        if (!($custom_arg instanceof CustomArg)) {
            throw new InvalidArgumentException(
                '$custom_arg must be an instance of SendGrid\Mail\CustomArg'
            );
        }

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
        if (!($send_at instanceof SendAt)) {
            throw new TypeException(
                '$send_at must be an instance of SendGrid\Mail\SendAt'
            );
        }
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
        if (is_bool($has_dynamic_template) != true) {
            throw new TypeException(
                '$has_dynamic_template must be a boolean'
            );
        }
        $this->has_dynamic_template = $has_dynamic_template;
    }

    /**
     * Determine if this Personalization object is using dynamic templates
     *
     * @return bool
     */
    public function getHasDynamicTemplate()
    {
        return is_bool($this->has_dynamic_template) && ($this->has_dynamic_template);
    }

    /**
     * Collects all properties of Personalization instance and return.
     *
     * @return array
     */
    public function getProperties()
    {
        return [
            'tos' => $this->tos,
            'ccs' => $this->ccs,
            'bccs' => $this->bccs,
            'subject' => $this->subject,
            'headers' => $this->headers,
            'substitutions' => $this->substitutions,
            'dynamic_template_data' => $this->dynamic_template_data,
            'has_dynamic_template' => $this->has_dynamic_template,
            'custom_args' => $this->custom_args,
            'send_at' => $this->send_at
        ];
    }

    /**
     * Returns unique object identifier.
     *
     * @return string
     */
    public function getObjectIdentifier()
    {
        //  Starting PHP version 7.2, spl_object_id can be used
        //  Due to supporting PHP 5.6 and IDE error flag, spl_object_hash is used
        return spl_object_hash($this);
    }

    /**
     * Copies properties from provided Personalization to this instance.
     *
     * @param Personalization $personalization Source Personalization
     */
    public function copyFromPersonalization($personalization)
    {
        //  Not a Personalization instance? Reject
        if (!($personalization instanceof Personalization)) {
            throw new InvalidArgumentException(
                "Provided personalization isn't a Personalization instance"
            );
        }

        //  Define properties able for merge
        $mergeProperties = [
            'substitutions',
            'dynamic_template_data',
            'custom_args'
        ];

        //  Collect arguments to copy from source
        foreach ($personalization->getProperties() as $property => $value) {
            //  Value equals null or given property doesn't exists?
            if ((null === $value) || !property_exists($this, $property)) {
                //  Ignore this property
                continue;
            }

            //  If property of instance equals null
            if (null === $this->{$property}) {
                //  Overwrite value and move on
                $this->{$property} = $value;
                continue;
            }

            //  Collision: both Personalization properties have value set
            //  Get value of existing property
            $existingValue = $this->{$property};

            //  Don't overwrite existingValue if an object or array
            //  Also skip if property can't be merged
            if (
                !is_array($existingValue) ||
                !is_array($value) ||
                !in_array($property, $mergeProperties)
            ) {
                continue;
            }

            //  Merge properties stored in array
            $this->{$property} = array_merge($value, $existingValue);
        }
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
                'cc' => $this->getCcs(),
                'bcc' => $this->getBccs(),
                'subject' => $this->getSubject(),
                'headers' => $this->getHeaders(),
                'substitutions' => $substitutions,
                'dynamic_template_data' => $dynamic_substitutions,
                'custom_args' => $this->getCustomArgs(),
                'send_at' => $this->getSendAt()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
