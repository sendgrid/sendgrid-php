<?php
/**
 * This file tests BatchId.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BatchId;
use SendGrid\Mail\TypeException;

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

    public function testSetBatchIdOnInvalidBatchId()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$batch_id" must be a string/');

        $batch_id = new BatchId();
        $batch_id->setBatchId(123);
    }

    public function testJsonSerialize()
    {
        $batchId = new BatchId();

        $this->assertNull($batchId->jsonSerialize());
    }
}
