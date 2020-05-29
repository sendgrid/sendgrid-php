<?php

namespace SendGrid\Tests\Unit;

use OverflowException;
use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;

/**
 * This class tests functionality of Personalization instances.
 *
 * @package SendGrid\Tests\Unit
 */
class PersonalizationTest extends TestCase
{
    public function testLimitOverflow()
    {
        $this->expectException(OverflowException::class);

        $mail = new Mail();

        for ($i = 1; $i <= 2000; $i++) {
            $personalization = new Personalization();
            $mail->addPersonalization($personalization);
        }
    }

    public function testCreateUsingCount()
    {
        $mail = new Mail();

        $countBegin = $newIndex = $mail->getPersonalizationCount();
        $countTest = 10;
        $countExpect = $countBegin + $countTest;

        for ($i = 1; $i <= $countTest; $i++) {
            //  Create instances by count
            $mail->addTo('testing+' . $i . '@example.com', null, null, $newIndex);

            //  Calculate next newIndex entry
            $newIndex = $mail->getPersonalizationCount();
        }

        $this->assertEquals($countExpect, $newIndex);
    }

    public function testCountAfterCreations()
    {
        $mail = new Mail();

        $countBegin = $mail->getPersonalizationCount();
        $countTest = 10;
        $countExpect = $countBegin + $countTest;

        for ($i = 1; $i <= $countTest; $i++) {
            $mail->addPersonalization(new Personalization());
        }

        $countResult = $mail->getPersonalizationCount();
        $this->assertEquals($countExpect, $countResult);
    }
}
