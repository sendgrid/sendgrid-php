<?php

class SendGrid
{
    const VERSION = "2.1.1";

    const RESPONSE_SUCCESS_MSG  = 'success';
    const RESPONSE_ERROR_MSG    = 'error';

    /**
     * @var int The API call had an error in the parameters. The error will be encoded in the body of the response.
     */
    const ERROR_TYPE_INCORRECT_PARAMS   = 400;

    /**
     * @var int The API call was unsuccessful. You should retry later.
     */
    const ERROR_TYPE_SENDGRID_FAIL      = 500;

    protected   $api_user,
                $api_key,
                $options = array(
                    'protocol'                  => 'https',
                    'host'                      => 'api.sendgrid.com',
                    'port'                      => 443,
                    'turn_off_ssl_verification' => false,
                    'unirest'                   => null,
                    'use_concise_answers'       => false
                ),
                $last_errors = array(),
                $last_errors_type;

    public function __construct($api_user, $api_key, $options = array())
    {
        $this->api_user = $api_user;
        $this->api_key = $api_key;

        foreach ($options as $key => $value) {
            $this->options[$key] = $value;
        }

        if ($this->options['turn_off_ssl_verification'] == true) {
            $this->getUnirest()->verifyPeer(false);
        }
    }

    protected function getUnirest() {
        return $this->options['unirest'] ? $this->options['unirest'] : new \Unirest;
    }

    protected function getUrlToEndpoint($endpoint) {
        return sprintf("%s://%s:%d/api/%s", $this->options['protocol'], $this->options['host'], $this->options['port'], $endpoint);
    }

    protected function getHeaders() {
        return array('User-Agent' => 'sendgrid/' . self::VERSION . ';php');
    }

    /**
     * @param \Unirest\HttpResponse $rawResp
     * @return mixed
     */
    protected function getResponse(\Unirest\HttpResponse $rawResp) {
        $body = $rawResp->body;
        if (!$this->options['use_concise_answers']) {
            return $body;
        }
        if (property_exists($body, 'message') && $body->message = self::RESPONSE_SUCCESS_MSG) {
            return true;
        }
        if (property_exists($body, 'errors')) {
            $this->last_errors = (array) $body->errors;
        }
        if (property_exists($body, 'error')) {
            $this->last_errors = array($body->error);
        }
        if ($rawResp->code >= 400 && $rawResp->code < 500) {
            $this->last_errors_type = self::ERROR_TYPE_INCORRECT_PARAMS;
        } else if ($rawResp->code >= 500 && $rawResp->code < 600) {
            $this->last_errors_type = self::ERROR_TYPE_SENDGRID_FAIL;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getLastErrors() {
        return $this->last_errors;
    }

    /**
     * @return int | null
     */
    public function getLastErrorsType() {
        return $this->last_errors_type;
    }

    /**
     * @param \SendGrid\Email $email
     * @return mixed
     */
    public function send(SendGrid\Email $email)
    {
        $form = $email->toWebFormat();
        $form['api_user'] = $this->api_user;
        $form['api_key'] = $this->api_key;

        $response = $this->getUnirest()->post($this->getUrlToEndpoint('mail.send.json'), $this->getHeaders(), $form);
        return $this->getResponse($response);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function unsubscribe($email)
    {
        $form = array(
            'api_user'  => $this->api_user,
            'api_key'   => $this->api_key,
            'email'     => $email
        );

        $response = $this->getUnirest()->post($this->getUrlToEndpoint('unsubscribes.add.json'), $this->getHeaders(), $form);
        return $this->getResponse($response);
    }

}
