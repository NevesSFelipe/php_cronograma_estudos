<?php

    namespace App\model;

    use PDO;

    class CursosModel {

        private PDO $conexao;

        public function __construct($conexao)
        {
            $this->conexao = $conexao;
        }

        public function consultarCursos(string $titulo_formacao): array
        {
            $condicaoWhere = $titulo_formacao == '' ? '' : "titulo_formacao = '{$titulo_formacao}'";
            $where = empty($condicaoWhere) ? '' : "WHERE {$condicaoWhere}";

            $sql = "SELECT * FROM cursos {$where} ORDER BY titulo_curso ASC";

            $stm = $this->conexao->prepare($sql);

            $retorno = $stm->execute() === false 
                ? $this->tratarRetorno(array()) 
                : $this->tratarRetorno($stm->fetchAll(PDO::FETCH_ASSOC))
            ;
        
            return $retorno;
 
        }

        private function tratarRetorno(array $retorno): array
        {
            header('Content-Type: application/json');

            $data = array(
                'status' => 'success',
                'data' => $retorno
            );
            
            return $data;
        }
    }