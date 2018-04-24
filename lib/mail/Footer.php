<?php namespace SendGrid\Mail;

class Footer implements \JsonSerializable
{
    private $enable;
    private $text;
    private $html;

    public function __construct($enable=null, $text=null, $html=null)
    {
        if(isset($enable)) $this->setEnable($enable);
        if(isset($text)) $this->setText($text);
        if(isset($html)) $this->setHtml($html);
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'text'   => $this->getText(),
                'html'   => $this->getHtml()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
