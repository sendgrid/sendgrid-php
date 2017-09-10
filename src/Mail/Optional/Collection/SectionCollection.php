<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Collection\Collection;
use SendGrid\Mail\Optional\Section;

final class SectionCollection extends Collection
{
    /**
     * @param Section $section
     * @return $this
     */
    public function add(Section $section)
    {
        $this->collection[] = $section;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = [];

        $this->each(function (Section $customArgument) use (&$array) {
            $array[$customArgument->getKey()] = $customArgument->getValue();
        });

        return $array;
    }
}
