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
    
    public static function tryProcessImg($filename) {
        if (isset($_FILES[$filename])) {
            $file = $_FILES[$filename];
            if(!empty($file["name"])) {
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $info = getimagesize($file['tmp_name']);
                    if ($info !== false && ($info[2] === IMAGETYPE_JPEG || $info[2] === IMAGETYPE_PNG)) {
                        $fp = fopen($file['tmp_name'], 'rb');
                        return $fp;
                    } else {
                        throw new HTTPSpecialCaseException(400, "Image submitted is not jpeg/png");
                    }
                } else {
                    throw new HTTPSpecialCaseException(400, "Image upload error");
                }
            }
        }
        return null;
    }
}
