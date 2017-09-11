<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Mail\Optional\ReplyTo;
use SendGrid\Collection\Collection;

final class ReplyToCollection extends Collection
{
    /**
     * @param ReplyTo $replyTo
     * @return ReplyToCollection
     */
    public function add(ReplyTo $replyTo)
    {
        $this->collection[] = $replyTo;

        return $this;
    }
}
