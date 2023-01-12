<?php

require 'Kernel/Constants.php';

final class AutoLoad
{
    public static function loadKernelClass ($S_className)
    {
        $S_file = Constants::kernelDir() . "$S_className.php";
        return static::_load($S_file);
    }

    public static function loadExceptionClass ($S_className)
    {
        $S_file = Constants::exceptionsDir() . "$S_className.php";

        return static::_load($S_file);
    }

    public static function loadModelClass ($S_className)
    {
        $S_file = Constants::modelsDir() . "$S_className.php";

        return static::_load($S_file);
    }


    public static function loadViewClass ($S_className)
    {
        $S_path = Constants::viewsDir() . "$S_className.php";

        return static::_load($S_path);
    }

    public static function loadControllerClass ($S_className)
    {
        $S_path = Constants::controllersDir() . "$S_className.php";

        return static::_load($S_path);
    }
    private static function _load($S_path)
    {
        if (is_readable($S_path))
        {
            require $S_path;
        }
    }
}

spl_autoload_register('AutoLoad::loadKernelClass');
spl_autoload_register('AutoLoad::loadExceptionClass');
spl_autoload_register('AutoLoad::loadModelClass');
spl_autoload_register('AutoLoad::loadViewClass');
spl_autoload_register('AutoLoad::loadControllerClass');
