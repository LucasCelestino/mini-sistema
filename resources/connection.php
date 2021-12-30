<?php

class Connection
{
    private static $pdo;

    public static function getConnection()
    {
        if(empty(self::$pdo))
        {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_CASE => PDO::CASE_NATURAL,
                PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
                PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8'
            ];

            self::$pdo = new PDO("mysql:dbname=crud;host=localhost", 'root', '', $options);
        }

        return self::$pdo;
    }
}