<?php

namespace Test\Asm;

use SendGrid\Mail\Optional\Asm;

final class AsmTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @return void
     */
    public function itShouldSerializeSuccessfully()
    {
        $this->assertSame(
            json_encode(new Asm(99, [4,5,6])),
            $this->getExpectedDecoded()
        );
    }

    /**
     * @return string
     */
    private function getExpectedDecoded()
    {
        return json_encode(
            json_decode($this->getExpectedJson())
        );
    }

    /**
     * @return string
     */
    private function getExpectedJson()
    {
        return <<<JSON
        {
           "group_id":99,
           "groups_to_display":[
              4,
              5,
              6
           ]
        }
JSON;
    }
}
