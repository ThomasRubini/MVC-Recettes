<?php

final class Utils
{

    public static function getOrDie($DICT, $key)
    {
        if (isset($DICT[$key])) return $DICT[$key];
        else die("Key $key not present");
    }

    public static function intOrDie($data)
    {
        if (is_numeric($data)) return (int) $data;
        else die("Not an int");
    }

}
