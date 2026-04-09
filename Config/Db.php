<?php

class Database
{
    private static $connection = null;

    public static function conectar()
    {
        if (self::$connection === null) {
            try {
                $host = 'localhost';
                $dbname = 'eva1';
                $username = 'root';
                $password = '';
                self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
