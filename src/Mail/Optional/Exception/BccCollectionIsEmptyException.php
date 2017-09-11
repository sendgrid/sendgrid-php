<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class BccCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Bcc';
}
