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

        public function editarStatusCurso(int $idCurso, bool $novoStatusCurso): array
        {
            $where = "id_curso = :id_curso";
            $sql = "UPDATE cursos SET status = :status WHERE $where";

            $stm = $this->conexao->prepare($sql);

            $stm->bindParam(':id_curso', $idCurso);
            $stm->bindParam(':status', $novoStatusCurso);

            $retorno = ($stm->execute() === false || $stm->rowCount() == 0) 
                ? array('status' => 'false', 'data' => 'Não foi possível atualizar o status do curso.')
                : array('status' => 'true', 'data' => 'Status do curso atualizado com sucesso.')
            ;
        
            return $retorno;
        }

        public function buscarCursoPorNome(string $nome_curso): array
        {
            $where = "WHERE titulo_curso LIKE '%{$nome_curso}%'";

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