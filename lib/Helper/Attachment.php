<?php

namespace SendGrid\Helper;

/**
 * Class Attachment
 * @package SendGrid\Helper
 */
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
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;
        return $this;
    }

    public function getDisposition()
    {
        return $this->disposition;
    }

    public function setContentID($content_id)
    {
        $this->content_id = $content_id;
        return $this;
    }

    public function getContentID()
    {
        return $this->content_id;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'content' => $this->getContent(),
                'type' => $this->getType(),
                'filename' => $this->getFilename(),
                'disposition' => $this->getDisposition(),
                'content_id' => $this->getContentID()
            ]
        );
    }
}
