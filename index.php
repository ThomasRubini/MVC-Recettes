<?php
    // Application entry point

    require 'vendor/autoload.php';
    require 'Kernel/AutoLoad.php';

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
        $O_controller->execute();
    }
    catch (ControleurException $O_exception)
    {
        echo ('An error occured: ' . $O_exception->getMessage());
    }


    $content = View::closeBuffer();

    View::show('html', array('body' => $content));