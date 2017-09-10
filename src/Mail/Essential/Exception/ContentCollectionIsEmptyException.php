<?php

namespace SendGrid\Mail\Essential\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class ContentCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Content';
}
