<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Mail\Optional\Header;
use SendGrid\Collection\Collection;

final class HeaderCollection extends Collection
{
    /**
     * @param Header $header
     * @return HeaderCollection
     */
    public function add(Header $header)
    {
        $this->collection[] = $header;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = [];

        $this->each(function (Header $header) use (&$array) {
            $array[$header->getKey()] = $header->getValue();
        });

        return $array;
    }
}
