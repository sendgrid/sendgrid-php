<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Mail\Optional\Cc;
use SendGrid\Collection\Collection;

final class CcCollection extends Collection
{
    /**
     * @param Cc $cc
     * @return CcCollection
     */
    public function add(Cc $cc)
    {
        $this->collection[] = $cc;

        return $this;
    }
}
