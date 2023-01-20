<?php

final class controller
{
    private $_A_urlParts;

    private $_A_urlParams;

    private $_A_postParams;

    public function __construct ($S_url, $A_postParams, $A_getParams)
    {
        // Remove the trailing slash
        if ('/' == substr($S_url, -1, 1)) {
            $S_url = substr($S_url, 0, strlen($S_url) - 1);
        }

        // Remove the leading slash
        if ('/' == substr($S_url, 0, 1)) {
            $S_url = substr($S_url, 1, strlen($S_url));
        }

        // split the url
        $_A_urlParts = explode('/', $S_url);

        if (empty($_A_urlParts[0])) {
            $_A_urlParts[0] = 'DefaultController';
        } else {
            $_A_urlParts[0] = ucfirst($_A_urlParts[0]) . "Controller";
        }

        if (empty($_A_urlParts[1])) {
            $_A_urlParts[1] = 'defaultAction';
        } else {
            $_A_urlParts[1] = $_A_urlParts[1] . 'Action';
        }


        $this->_A_urlParts['controller'] = array_shift($_A_urlParts);
        $this->_A_urlParts['action']     = array_shift($_A_urlParts);

        $this->_A_urlParams = $_A_urlParts;

        $this->_A_postParams = $A_postParams;

        $this->_A_getParams = $A_getParams;


    }

    // Execute the controller and action deduced

    public function execute()
    {
        if (!class_exists($this->_A_urlParts['controller'])) {
            throw new ControllerException("Controller " . $this->_A_urlParts['controller'] . " is not valid.");
        }

        if (!method_exists($this->_A_urlParts['controller'], $this->_A_urlParts['action'])) {
            throw new ControllerException("Action " . $this->_A_urlParts['action'] . " of controller " .
                $this->_A_urlParts['controller'] . " is not valid.");
        }

        
        $B_called = call_user_func_array(array(
            new $this->_A_urlParts['controller'],
            $this->_A_urlParts['action']),
            array($this->_A_urlParams, $this->_A_postParams, $this->_A_getParams)
        );

        if (false === $B_called) {
            throw new ControllerException("Action " . $this->_A_urlParts['action'] .
                " of controller " . $this->_A_urlParts['controller'] . " failed.");
        }
    }
}