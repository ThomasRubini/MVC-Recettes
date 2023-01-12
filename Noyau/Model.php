<?php

final class Model
{
    private static $conn = null;

    public static function get(){
        if($conn === null){
            init();
        }
        return $conn;
    }

    private static function init(){
        $PDO_URI = sprintf("mysql:host=%s;dbname=%s", $_ENV["DB_HOST"], $_ENV["DB_DBNAME"]);

        try{
            $conn = new PDO($PDO_URI, $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
        }catch(PDOException $e){
            die("Connection to the database failed");
        } 
    }
}
