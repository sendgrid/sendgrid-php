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

namespace Helpers;

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
        $this->substitutions[$key] = $value;
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
