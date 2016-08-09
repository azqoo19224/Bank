<?php
class DB 
{
    public static $db;
    public static function pdoConnect() 
    {
        $config['db']['dsn'] = 'mysql:host=localhost; dbname=Booking; charset=utf8';
        $config['db']['user'] = 'root';
        $config['db']['password'] = '0000';
        $db = new PDO(
            $config['db']['dsn'], 
            $config['db']['user'], 
            $config['db']['password'], 
            array(
                PDO::ATTR_EMULATE_PREPARES=>false, 
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                )
            );
        DB::$db = $db;

    }
}
?>