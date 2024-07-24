<?php

    namespace App\core;

    use PDO;

    class Model {

        protected PDO $conexao;

        public function __construct()
        {
            $caminhoAbsolutoBaseDados = __DIR__ . '\database\formacoes.sqlite';
            $this->conexao = new PDO("sqlite:" . $caminhoAbsolutoBaseDados);
        }
    }