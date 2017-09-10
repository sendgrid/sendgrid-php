<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Collection\Collection;
use SendGrid\Mail\Optional\Personalization;

final class PersonalizationCollection extends Collection
{
    /**
     * @param Personalization $personalization
     * @return $this
     */
    public function add(Personalization $personalization)
    {
        $this->collection[] = $personalization;

        return $this;
    }
}
