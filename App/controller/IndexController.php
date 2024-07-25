<?php

    namespace App\controller;

    use PDO;
    use App\core\DataBase;
    use App\core\Controller;
    use App\controller\Template\Template;
    use App\model\CursosModel;

    class IndexController extends Controller implements Template {

        private PDO $conexao;

        public function __construct()
        {
            $this->conexao = DataBase::estabelecerConexaoSQLITE();
        }

        public function index()
        {
            $this->carregarView('index');    
        }

        public function consultarCursos($titulo_formacao = '')
        {
            $cursos = new CursosModel($this->conexao);
            $arrayCursos = $cursos->consultarCursos($titulo_formacao);
            print(json_encode($arrayCursos));
        }

    }