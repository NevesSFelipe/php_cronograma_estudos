<?php

    namespace App\core;

    use PDO;

    class DataBase {

        public static function estabelecerConexaoSQLITE(): PDO
        {
            $caminhoAbsolutoBaseDados = __DIR__ . '\database\formacoes.sqlite';
            return new PDO("sqlite:" . $caminhoAbsolutoBaseDados);
        }
    }