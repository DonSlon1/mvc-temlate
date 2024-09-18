<?php
namespace App\Core;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;

class Database {
    private static $connection;

    public static function getConnection() {
        if (self::$connection === null) {
            $config = new Configuration();
            $connectionParams = [
                'dbname' => 'testtt',
                'user' => 'root',
                'password' => 'root',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];
            self::$connection = DriverManager::getConnection($connectionParams, $config);
        }
        return self::$connection;
    }
}