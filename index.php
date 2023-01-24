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

    try
    {
        $O_controller = new Controller($S_url, $A_postParams, $A_getParams);
        $ret = $O_controller->execute();
    }
    catch (ControleurException $O_exception)
    {
        View::openBuffer();
        View::show("errors/500", $O_exception->getMessage());
    }
    catch (NotFoundException $O_exception)
    {
        View::openBuffer();
        View::show("errors/404");
    }
    catch (HTTPSpecialCaseException $O_exception)
    {
        View::openBuffer();
        View::show("errors/".$O_exception->getHTTPCode(), $O_exception->getMsg());
    }


    $content = View::closeBuffer();

    if($ret === Utils::RETURN_HTML){
        View::show('html', array('body' => $content));
    }else if($ret === Utils::RETURN_RAW){
        echo $content;
    }else{
        throw new Exception("Invalid return value: $ret");
    }