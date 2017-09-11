<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class SectionCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Section';
}
