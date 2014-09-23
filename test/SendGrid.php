<?php

use Mockery as m;

class SendGridTest_SendGrid extends PHPUnit_Framework_TestCase
{
    const SENDGRID_ACTUAl_VERSION = "2.1.1";

    const SENDGRID_API_USER = 'test_user';
    const SENDGRID_API_KEY  = 'test_key';

    /**
     * @var \Mockery\MockInterface
     */
    protected $unirest;

    public function setUp()
    {
        $this->unirest = m::mock('\Unirest');
    }

    public function tearDown()
    {
        m::close();
    }

    public function testVersion()
    {
        $this->assertEquals(SendGrid::VERSION, self::SENDGRID_ACTUAl_VERSION);
    }

    /**
     * @return array
     */
    protected function getSendgridHeaders()
    {
        return array('User-Agent' => 'sendgrid/' . SendGrid::VERSION . ';php');
    }

    /**
     * @param array $options
     * @return SendGrid
     */
    protected function getSendgridInstance($options = array())
    {
        return new SendGrid(self::SENDGRID_API_USER, self::SENDGRID_API_KEY, $options);
    }

    /**
     * @return \SendGrid\Email
     */
    protected function getEmailInstance()
    {
        return new SendGrid\Email();
    }

    protected function getResponse($body, $code=0, $headers="\r\nX-TEST: 11") {
        if (is_array($body)) {
            $body = json_encode($body);
        }
        return new \Unirest\HttpResponse($code, $body, $headers);
    }

    /**
     * @dataProvider optionsForUrlConfiguringTests
     */
    public function testConfiguringWithUrlOptions($options, $expectedUrl)
    {
        $this->unirest->shouldReceive('post')
            ->with(
                $expectedUrl . '/mail.send.json',
                m::any(),
                m::any())
            ->andReturn($this->getResponse('some_body'));
        $options['unirest'] = $this->unirest;
        $sendgrid = $this->getSendgridInstance($options);
        $sendgrid->send($this->getEmailInstance());
    }

    public function optionsForUrlConfiguringTests() {
        return array(
            array(
                array('protocol'=>'http'),
                'http://api.sendgrid.com:443/api'),
            array(
                array('host'=>'sendgrid.com'),
                'https://sendgrid.com:443/api'),
            array(
                array('port'=>8080),
                'https://api.sendgrid.com:8080/api'),
            array(
                array('protocol' => 'http', 'host' => 'sendgrid.com', 'port'=>8080),
                'http://sendgrid.com:8080/api'),
        );
    }

    public function testConfiguringSslVerification()
    {
        $this->unirest->shouldReceive('verifyPeer')->once()->with(false);
        $this->getSendgridInstance(array(
            'turn_off_ssl_verification' => true,
            'unirest'                   => $this->unirest
        ));
    }

    public function testSendEmail()
    {
        $email = $this->getEmailInstance()->addTo('test@gmail.com');
        $expectedResponse = 'bodyContent';
        $this->unirest->shouldReceive('post')
            ->once()
            ->with(
                'https://api.sendgrid.com:443/api/mail.send.json',
                $this->getSendgridHeaders() ,
                array_merge(
                    $email->toWebFormat(),
                    array('api_user' => self::SENDGRID_API_USER, 'api_key' => self::SENDGRID_API_KEY)
                ))
            ->andReturn($this->getResponse($expectedResponse));
        $sendgrid   =   $this->getSendgridInstance(array('unirest' => $this->unirest));
        $response   =   $sendgrid->send($email);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testConfiguringWithResponseOptionsDuringSuccessCall() {
        $this->unirest->shouldReceive('post')->andReturn(
            $this->getResponse(json_encode(array('message'=>SendGrid::RESPONSE_SUCCESS_MSG)), 200)
        );
        $options = array(
            'unirest'               => $this->unirest,
            'use_concise_answers'   => true
        );
        $sendgrid = $this->getSendgridInstance($options);
        $this->assertTrue($sendgrid->send($this->getEmailInstance()));
    }

    public function testConfiguringWithResponseOptionsDuringCallWithBadParams() {
        $errors = array('some error 1', 'some error 2');
        $this->unirest->shouldReceive('post')->andReturn(
            $this->getResponse(json_encode(array('errors'=>$errors)), 400)
        );
        $options = array(
            'unirest'               => $this->unirest,
            'use_concise_answers'   => true
        );
        $sendgrid = $this->getSendgridInstance($options);
        $this->assertFalse($sendgrid->send($this->getEmailInstance()));
        $this->assertEquals($errors, $sendgrid->getLastErrors());
        $this->assertEquals(SendGrid::ERROR_TYPE_INCORRECT_PARAMS, $sendgrid->getLastErrorsType());
    }

    public function testConfiguringWithResponseOptionsDuringCallWithSendgridFail() {
        $errors = array('some error 1', 'some error 2');
        $this->unirest->shouldReceive('post')->andReturn(
            $this->getResponse(array('errors'=>$errors), 500)
        );
        $options = array(
            'unirest'               => $this->unirest,
            'use_concise_answers'   => true
        );
        $sendgrid = $this->getSendgridInstance($options);
        $this->assertFalse($sendgrid->send($this->getEmailInstance()));
        $this->assertEquals($errors, $sendgrid->getLastErrors());
        $this->assertEquals(SendGrid::ERROR_TYPE_SENDGRID_FAIL, $sendgrid->getLastErrorsType());
    }

    public function testUnsubscribeWithDetailedResponse() {
        $email = 'test@gmail.com';
        $expectedResponse = 'bodyContent';
        $this->unirest->shouldReceive('post')
            ->once()
            ->with(
                'https://api.sendgrid.com:443/api/unsubscribes.add.json',
                $this->getSendgridHeaders() ,
                array('api_user' => self::SENDGRID_API_USER, 'api_key' => self::SENDGRID_API_KEY, 'email' => $email)
            )
            ->andReturn($this->getResponse($expectedResponse));
        $sendgrid   =   $this->getSendgridInstance(array('unirest' => $this->unirest));
        $response   =   $sendgrid->unsubscribe($email);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testUnsubscribeWithConciseResponse() {
        $email = 'test@gmail.com';
        $this->unirest->shouldReceive('post')
            ->once()
            ->with(
                'https://api.sendgrid.com:443/api/unsubscribes.add.json',
                $this->getSendgridHeaders() ,
                array('api_user' => self::SENDGRID_API_USER, 'api_key' => self::SENDGRID_API_KEY, 'email' => $email)
            )
            ->andReturn(
                $this->getResponse(array('message'=>SendGrid::RESPONSE_SUCCESS_MSG))
            );
        $sendgrid = $this->getSendgridInstance(array('unirest' => $this->unirest, 'use_concise_answers'=>true));
        $this->assertTrue($sendgrid->unsubscribe($email));
    }
}
