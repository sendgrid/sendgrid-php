<?php

class SendGridTest_Exception extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
    }

    public function testConstructionException()
    {
        $err = new SendGrid\Exception();
        $this->assertEquals(get_class($err), 'SendGrid\Exception');
    }

    // public function testGetErrors()
    // {
        // $mockResponse = new SendGrid\Response(400, "{'message': 'error', 'errors': ['Bad username / password']}");
        // $res = new SendGrid\Response(200, 'headers', 'raw_body', 'body');
        // try {
            // throw new SendGrid\Exception(json_decode("{'message': 'error', 'errors': ['Bad username / password']}"));
        // } catch (SendGrid\Exception $e) {
            // var_dump($e->getErrors());
        // }
        // // $this->assertEquals($err->getErrors()[0], 'Bad username / password');
    // }

}
