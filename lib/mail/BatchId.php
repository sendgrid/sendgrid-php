<?php namespace SendGrid\Mail;

class BatchId implements \JsonSerializable
{
    public $batch_id;

    public function __construct($batch_id)
    {
        $this->batch_id = $batch_id;
    }

    public function getBatchId()
    {
        return $this->batch_id;
    }

    public function setBatchId($batch_id)
    {
        $this->batch_id = $batch_id;
    }

    public function jsonSerialize()
    {
        return $this->getBatchId();
    }
}
