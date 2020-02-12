<?php

class Db{
    
    public static function getConnection(){
        $params = require(ROOT.'/config/params.php');
        $connection = new PDO("mysql:host=".$params['host'].";dbname=".$params['dbname'],$params['username'],$params['password']);
        return $connection;
    }
}