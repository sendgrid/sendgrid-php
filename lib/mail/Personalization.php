<?php namespace SendGrid\Mail;

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
