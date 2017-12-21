<?php namespace SendGrid\Helpers\Mail\Model;

class SpamCheck implements \JsonSerializable
{
    private $enable;
    private $threshold;
    private $post_to_url;

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;
    }

    public function getThreshold()
    {
        return $this->threshold;
    }

    public function setPostToUrl($post_to_url)
    {
        $this->post_to_url = $post_to_url;
    }

    public function getPostToUrl()
    {
        return $this->post_to_url;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable'      => $this->getEnable(),
                'threshold'   => $this->getThreshold(),
                'post_to_url' => $this->getPostToUrl()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
