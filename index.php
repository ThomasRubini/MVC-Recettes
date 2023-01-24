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

    try
    {
        $O_controller = new Controller($S_url, $A_postParams, $A_getParams);
        $ret = $O_controller->execute();
    }
    catch (ControleurException $O_exception)
    {
        echo ('An error occured: ' . $O_exception->getMessage());
    }
    catch (HTTPSpecialCaseException $O_exception)
    {
        // drop old buffer
        View::closeBuffer();
        View::openBuffer();

        View::show("errors/".$O_exception->getHTTPCode(), $O_exception->getMsg());

        $content = View::closeBuffer();
        View::show('html', array('body' => $content));
        return;
    }


    $content = View::closeBuffer();

    if($ret === Utils::RETURN_HTML){
        View::show('html', array('body' => $content));
    }else if($ret === Utils::RETURN_RAW){
        echo $content;
    }else{
        throw new Exception("Invalid return value: $ret");
    }