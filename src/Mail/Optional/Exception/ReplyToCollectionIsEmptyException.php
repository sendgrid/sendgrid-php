<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class ReplyToCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Reply to';
}
