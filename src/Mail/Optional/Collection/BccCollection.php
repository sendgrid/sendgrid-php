<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Collection\Collection;
use SendGrid\Mail\Optional\Bcc;

final class BccCollection extends Collection
{
    /**
     * @param Bcc $bcc
     * @return BccCollection
     */
    public function add(Bcc $bcc)
    {
        $this->collection[] = $bcc;

        return $this;
    }
}
