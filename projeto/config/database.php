<?php

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $name = 'agenda';

            try {
                self::$instance = new PDO(
                    "mysql:host={$host};dbname={$name};charset=utf8",
                    $user,
                    $pass
                );

                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$instance->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
