<?php namespace SendGrid\Mail;

class TemplateId implements \JsonSerializable
{
    public $template_id;

    public function __construct($template_id)
    {
        $this->template_id = $template_id;
    }

    public function getTemplateId()
    {
        return $this->template_id;
    }

    public function setTemplateId($template_id)
    {
        $this->template_id = $template_id;
    }

    public function jsonSerialize()
    {
        return $this->getTemplateId();
    }
}
