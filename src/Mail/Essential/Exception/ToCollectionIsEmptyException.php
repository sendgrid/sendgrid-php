<?php

namespace SendGrid\Mail\Essential\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class ToCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'To';
}
