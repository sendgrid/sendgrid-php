<?php

namespace SendGrid\Mail\Optional\Collection;

use SendGrid\Collection\Collection;
use SendGrid\Mail\Optional\Category;

final class CategoryCollection extends Collection
{
    /**
     * @param Category $category
     * @return $this
     */
    public function add(Category $category)
    {
        $this->collection[] = $category;

        return $this;
    }
}
