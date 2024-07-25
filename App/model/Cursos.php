<?php

    namespace App\model;

    use App\core\Model;
    use PDO;

    class Cursos extends Model {

        private string $tabela;

        public function __construct()
        {
            parent::__construct();
            $this->tabela = 'cursos';
        }

        public function consultarCursos(string $indicesSelect = '*', string $condicaoWhere = ''): array
        {
            $where = empty($condicaoWhere) ? '' : "WHERE {$condicaoWhere}";
            $sql = "SELECT $indicesSelect FROM {$this->tabela} {$where} ORDER BY titulo_curso ASC";

            $stm = $this->conexao->prepare($sql);
            
            if($stm->execute() === false) { return array(); }

            return $stm->fetchAll(PDO::FETCH_ASSOC);
 
        }
    }