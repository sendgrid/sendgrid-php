<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Collection\Collection;
use SendGrid\Mail\Optional\Substitution;

final class SubstitutionCollection extends Collection
{
    /**
     * @param Substitution $substitution
     * @return SubstitutionCollection
     */
    public function addSubstitution(Substitution $substitution)
    {
        $this->collection[] = $substitution;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $array = [];

        $this->each(function (Substitution $header) use (&$array) {
            $array[$header->getKey()] = $header->getValue();
        });

        return $array;
    }
}
