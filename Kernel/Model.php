<?php

final class Model
{
    private static $conn = null;

    public static function get(){
        if(self::$conn === null){
            self::init();
        }
        return self::$conn;
    }

    private static function init(){
        $PDO_URI = sprintf("mysql:host=%s;dbname=%s", $_ENV["DB_HOST"], $_ENV["DB_DBNAME"]);

        try{
            self::$conn = new PDO($PDO_URI, $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
        }catch(PDOException $e){
            throw new HTTPSpecialCaseException(500, "Connection to the database failed");
        } 
    }
}
