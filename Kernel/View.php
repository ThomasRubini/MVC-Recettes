<?php

final class View
{
    public static function openBuffer()
    {
        ob_start();
    }

    public static function closeBuffer()
    {
        return ob_get_clean();
    }

    public static function show ($S_path, $A_params = array())
    {
        $S_file = Constants::viewsDir() . $S_path . '.php';
        $A_view = $A_params;

        ob_start();
        include $S_file;
        ob_end_flush();
    }
}