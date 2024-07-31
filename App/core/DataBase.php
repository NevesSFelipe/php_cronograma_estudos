<?php

    namespace App\core;

    use PDO;

    class DataBase {

        public static function estabelecerConexaoSQLITE(): PDO
        {
            $caminhoAbsolutoBaseDados = __DIR__ . '\database\formacoes.sqlite';
            return new PDO("sqlite:" . $caminhoAbsolutoBaseDados);
        }

        public static function estabelecerConexaoMySQL(): PDO
        {
            return new PDO("mysql:host=localhost;dbname=formacoes", "root", "");
        }
    }