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
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function addHeader($header)
    {
        $this->headers[$header->getKey()] = $header->getValue();
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function addSubstitution($substitution, $value=null)
    {
        if (!$substitution instanceof Substitution) {
            $key = $substitution;
            $substitution = new Substitution($key, $value);
        }
        $this->substitutions[$substitution->getKey()] = $substitution->getValue();
        
    }

    public function getSubstitutions()
    {
        return $this->substitutions;
    }

    public function addCustomArg($custom_arg)
    {
        $this->custom_args[$custom_arg->getKey()] = (string)$custom_arg->getValue();
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
