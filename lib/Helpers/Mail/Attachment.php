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

namespace SendGrid\Mail;

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
}
