<?php

class ModulesAutoLoad
{
    public static function loadModuleClass($S_className)
    {
        $dir = Constants::modulesDir();
        foreach (scandir($dir) as $path) {
            if($path === ".." || $path === ".") continue;
            $subdir = "$dir/$path";
            if (is_dir($subdir)) {
                static::_load("$subdir/$S_className.php");
            }
        }

    }

    private static function _load($S_path)
    {
        if (is_readable($S_path))
        {
            require $S_path;
        }
    }
    
}

spl_autoload_register('ModulesAutoLoad::loadModuleClass');