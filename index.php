<?php
    // Application entry point

    require 'vendor/autoload.php';
    require 'Kernel/AutoLoad.php';
    require 'Modules/AutoLoad.php';

    $dotenv = Dotenv\Dotenv::createImmutable(Constants::rootDir());
    $dotenv->load();

    $S_url = isset($_GET['url']) ? $_GET['url'] : null;
    $A_postParams = isset($_POST) ? $_POST : null;
    
    $A_getParams = isset($_GET) ? $_GET : null;
    unset($A_getParams["url"]);

    View::openBuffer();

    $ret = Utils::RETURN_HTML;
    $I_err_httpCode = null;
    $S_err_msg = null;

    try
    {
        $O_controller = new Controller($S_url, $A_postParams, $A_getParams);
        $ret = $O_controller->execute();
    }
    catch (ControleurException $O_exception)
    {
        View::openBuffer();
        $I_err_httpCode = 500;
        $S_err_msg = $O_exception->getMsg();
    }
    catch (NotFoundException $O_exception)
    {
        View::openBuffer();
        $I_err_httpCode = 404;
    }
    catch (HTTPSpecialCaseException $O_exception)
    {
        View::openBuffer();
        $I_err_httpCode = $O_exception->getHTTPCode();
        $S_err_msg = $O_exception->getMsg();
    }

    if ($I_err_httpCode !== null) {
        
        // do not disable redirects
        if(http_response_code() !== 302) {
            http_response_code($I_err_httpCode);
        }

        // Make the user see the error in these cases
        if($I_err_httpCode === 500 || $I_err_httpCode === 400) {
            header_remove("Location");
        }

        View::show("errors/".$I_err_httpCode, $S_err_msg);
    }


    $content = View::closeBuffer();

    if($ret === Utils::RETURN_HTML){
        View::show('html', array('body' => $content));
    }else if($ret === Utils::RETURN_RAW){
        echo $content;
    }else{
        throw new Exception("Invalid return value: $ret");
    }