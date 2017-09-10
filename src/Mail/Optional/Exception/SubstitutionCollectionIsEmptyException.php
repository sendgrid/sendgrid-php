<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class SubstitutionCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Substitution';
}
