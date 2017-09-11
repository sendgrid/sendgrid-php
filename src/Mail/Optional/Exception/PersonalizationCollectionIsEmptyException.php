<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class PersonalizationCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Personalization';
}
