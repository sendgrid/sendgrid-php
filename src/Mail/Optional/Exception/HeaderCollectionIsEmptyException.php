<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class HeaderCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Header';
}
