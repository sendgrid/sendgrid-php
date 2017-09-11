<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class CcCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Cc';
}
