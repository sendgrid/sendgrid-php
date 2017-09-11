<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class CategoryCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Category';
}
