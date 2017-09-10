<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class CustomArgumentCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Custom Argument';
}
