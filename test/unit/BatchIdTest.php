<?php
/**
 * This file tests BatchId.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BatchId;

/**
 * This file tests BatchId.
 *
 * @package SendGrid\Tests
 */
class BatchIdTest extends TestCase
{
    public function testConstructor()
    {
        $batchId = new BatchId('this_is_batch_id');

        $this->assertInstanceOf(BatchId::class, $batchId);
        $this->assertSame('this_is_batch_id', $batchId->getBatchId());
    }

    public function testSetBatchId()
    {
        $batchId = new BatchId();
        $batchId->setBatchId('this_is_batch_id');

        $this->assertSame('this_is_batch_id', $batchId->getBatchId());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$batch_id" must be a string.
     */
    public function testSetBatchIdOnInvalidBatchId()
    {
        $batch_id = new BatchId();
        $batch_id->setBatchId(['invalid_batch_id']);
    }

    public function testJsonSerialize()
    {
        $batchId = new BatchId();

        $this->assertNull($batchId->jsonSerialize());
    }
}
