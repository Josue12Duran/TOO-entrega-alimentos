<?php
class Database
{
    private static $pdo = null;

    public static function getConnection()
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config.php';
            $db = $config['db'];
            $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8mb4";
            try {
                self::$pdo = new PDO($dsn, $db['user'], $db['pass'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (\PDOException $e) {
                die('DB connection failed: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
