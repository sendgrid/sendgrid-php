<?php namespace SendGrid\Mail;

class Category implements \JsonSerializable
{
    private $category;

    public function __construct($category=null)
    {
        if(isset($category)) $this->setCategory($category);
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function jsonSerialize()
    {
        return $this->getCategory();
    }
}