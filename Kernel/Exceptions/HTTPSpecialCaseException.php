<?php

class HTTPSpecialCaseException extends Exception {

    protected $httpCode;
    protected $msg;

    public function __construct($httpCode, $msg = "") 
    {
        parent::__construct();
        $this->httpCode = $httpCode;
        $this->msg = $msg;
    }

    public function getHTTPCode(){
        return $this->httpCode;
    }

    public function getMsg(){
        return $this->code;
    }

}