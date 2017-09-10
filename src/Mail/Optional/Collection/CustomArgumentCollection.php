<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Collection\Collection;
use SendGrid\Mail\Optional\CustomArgument;

final class CustomArgumentCollection extends Collection
{
    /**
     * @param CustomArgument $customArgument
     * @return CustomArgumentCollection
     */
    public function add(CustomArgument $customArgument)
    {
        $this->collection[] = $customArgument;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = [];

        $this->each(function (CustomArgument $customArgument) use (&$array) {
            $array[$customArgument->getKey()] = $customArgument->getValue();
        });

        return $array;
    }
}
