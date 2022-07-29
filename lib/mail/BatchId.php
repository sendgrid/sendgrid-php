<?php
/**
 * This helper builds the BatchId object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a BatchId object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class BatchId implements \JsonSerializable
{
    /** @var $batch_id string This ID represents a batch of emails to be sent at the same time */
    private $batch_id;

    /**
     * Optional constructor
     *
     * @param string|null $batch_id This ID represents a batch of emails to
     *                              be sent at the same time
     * @throws \SendGrid\Mail\TypeException
     */
    public function __construct($batch_id = null)
    {
        if (isset($batch_id)) {
            $this->setBatchId($batch_id);
        }
    }

    /**
     * Add the batch id to a BatchId object
     *
     * @param string $batch_id This ID represents a batch of emails to be sent
     *                         at the same time
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function setBatchId($batch_id)
    {
        Assert::string($batch_id, 'batch_id');

        $this->batch_id = $batch_id;
    }

    /**
     * Return the batch id from a BatchId object
     *
     * @return string
     */
    public function getBatchId()
    {
        return $this->batch_id;
    }

    /**
     * Return an array representing a BatchId object for the Twilio SendGrid API
     *
     * @return null|string
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->getBatchId();
    }
}
