<?php


final class Constants
{

    const KERNEL_DIR       = '/Kernel/';

    const EXCEPTIONS_DIR  = '/Kernel/Exceptions/';

    const VIEWS_DIR        = '/Views/';

    const MODELS_DIR      = '/Models/';

    const CONTROLLERS_DIR = '/Controllers/';

    const MODULES_DIR = '/Modules/';


    public static function rootDir() {
        return realpath(__DIR__ . '/../');
    }

    public static function kernelDir() {
        return self::rootDir() . self::KERNEL_DIR;
    }

    public static function exceptionsDir() {
        return self::rootDir() . self::EXCEPTIONS_DIR;
    }

    public static function viewsDir() {
        return self::rootDir() . self::VIEWS_DIR;
    }

    public static function modelsDir() {
        return self::rootDir() . self::MODELS_DIR;
    }

    public static function controllersDir() {
        return self::rootDir() . self::CONTROLLERS_DIR;
    }

    public static function modulesDir() {
        return self::rootDir() . self::MODULES_DIR;
    }

}
