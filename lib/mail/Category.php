<?php namespace SendGrid\Mail;

class Category implements \JsonSerializable
{
    public $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function jsonSerialize()
    {
        return $this->getCategory();
    }
}