<?php

namespace SendGrid;

class Marketing extends Api {

    protected $domain = "https://sendgrid.com/";
    protected $endpoint = "api/newsletter/lists/email/add.json";
    protected $email;
    protected $listID;

    public function __construct($username, $password) {
        call_user_func_array("parent::__construct", func_get_args());
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getListID() {
        return $this->listID;
    }

    public function setListID($listID) {
        $this->listID = $listID;
        return $this;
    }

    
    public function execute() {

        $params =
                array(
                    'api_user' => $this->username,
                    'api_key' => $this->password,
                    'data' => json_encode(array('email' => $this->email, 'name' => '')),
                    'list' => $this->listID
        );

        $request = $this->domain.$this->endpoint;
    
        $session = curl_init($request);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($session, CURLOPT_TIMEOUT, 30);

        // obtain response
        $response = curl_exec($session);
                
        curl_close($session);

        return $response;
    }

}
