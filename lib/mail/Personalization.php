<?php 
/**
 * This helper builds the Personalization object for a /mail/send API call
 * 
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid 
 */
namespace SendGrid\Mail;

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
    // @var To[] objects
    private $tos;
    // @var Cc[] objects
    private $ccs;
    // @var Bcc[] objects
    private $bccs;
    // @var Subject object
    private $subject;
    // @var array of header key values
    private $headers;
    // @var array of substitution key values
    private $substitutions;
    // @var array of custom arg key values
    private $custom_args;
    // @var SendAt object
    private $send_at;

    /**
     * Add a To object to a Personalization object
     *
     * @param To $email To object
     * 
     * @return null
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
     * 
     * @return null
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
     * 
     * @return null
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
     * @return null
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Retrieve a Subject object from a Personalization object
     * 
     * @return Subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Add a Header object to a Personalization object
     *
     * @param Header $header Header object
     * 
     * @return null
     */ 
    public function addHeader($header)
    {
        $this->headers[$header->getKey()] = $header->getValue();
    }

    /**
     * Retrieve header key/value pairs from a Personalization object
     * 
     * @return array
     */ 
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Add a Substitution object or key/value to a Personalization object
     *
     * @param Substitution|string $substitution Substitution object or the key of a
     *                                          substitution
     * @param string|null         $value        The value of a substitution
     * 
     * @return null
     */ 
    public function addSubstitution($substitution, $value=null)
    {
        if (!$substitution instanceof Substitution) {
            $key = $substitution;
            $substitution = new Substitution($key, $value);
        }
        $this->substitutions[$substitution->getKey()] = $substitution->getValue();
    }

    /**
     * Retrieve substitution key/value pairs from a Personalization object
     * 
     * @return array
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
     * @return null
     */ 
    public function addCustomArg($custom_arg)
    {
        $this->custom_args[$custom_arg->getKey()] = (string)$custom_arg->getValue();
    }

    /**
     * Retrieve custom arg key/value pairs from a Personalization object
     * 
     * @return array
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
     * @return null
     */ 
    public function setSendAt($send_at)
    {
        $this->send_at = $send_at;
    }

    /**
     * Retrieve a SendAt object from a Personalization object
     * 
     * @return SendAt
     */ 
    public function getSendAt()
    {
        return $this->send_at;
    }

    /**
     * Return an array representing a Personalization object for the SendGrid API
     * 
     * @return null|array
     */  
    public function jsonSerialize()
    {
        return array_filter(
            [
                'to'            => $this->getTos(),
                'cc'            => $this->getCcs(),
                'bcc'           => $this->getBccs(),
                'subject'       => $this->getSubject(),
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
