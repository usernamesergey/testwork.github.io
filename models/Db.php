<?php
class Db{
    private static $db;

    protected function __construct() {}

    protected function __clone() {}

    public static function getInstance(){
        if (static::$db === null){
            static::$db = new mysqli("localhost", "root", "", "test");
            if (static::$db->connect_errno){
                throw new Error("Не удалось подключиться: %s\n", $db->connect_error);
            }
        }
        return static::$db;
    }
    public static function destruct(){
        if (static::$db !== null){
            static::$db->close();
        }
    }
    
}