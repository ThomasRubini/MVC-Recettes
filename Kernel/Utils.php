<?php

final class Utils
{

    public const RETURN_HTML = 2;
    public const RETURN_RAW = 3;

    public static function getOrDie($DICT, $key)
    {
        if (isset($DICT[$key])) return $DICT[$key];
        else throw new HTTPSpecialCaseException(400, "Key $key not present");
    }

    public static function intOrDie($data)
    {
        if (is_numeric($data)) return (int) $data;
        else throw new HTTPSpecialCaseException(400, "Not an int");
    }

}
