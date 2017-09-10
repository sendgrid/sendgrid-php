<?php

namespace SendGrid\Mail\Essential\Collection;

use SendGrid\Collection\Collection;
use SendGrid\Mail\Essential\Content;

final class ContentCollection extends Collection
{
    /**
     * @param Content $content
     * @return $this
     */
    public function add(Content $content)
    {
        $this->collection[] = $content;

        return $this;
    }
}
