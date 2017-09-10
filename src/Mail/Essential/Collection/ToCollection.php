<?php

namespace SendGrid\Mail\Essential\Collection;

use SendGrid\Mail\Essential\To;
use SendGrid\Collection\Collection;

final class ToCollection extends Collection
{
    /**
     * @param To $to
     * @return ToCollection
     */
    public function add(To $to)
    {
        $this->collection[] = $to;

        return $this;
    }
}
