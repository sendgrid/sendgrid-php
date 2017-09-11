<?php

namespace SendGrid\Mail\Optional\Exception;

use SendGrid\Collection\Exception\CollectionIsEmptyException;

final class AttachmentCollectionIsEmptyException extends CollectionIsEmptyException
{
    const ELEMENT = 'Attachment';
}
