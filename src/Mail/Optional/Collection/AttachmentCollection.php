<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Collection\Collection;
use SendGrid\Mail\Optional\Attachment;

final class AttachmentCollection extends Collection
{
    /**
     * @param Attachment $attachment
     */
    public function add(Attachment $attachment)
    {
        $this->collection[] = $attachment;
    }
}
