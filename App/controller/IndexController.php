<?php

    namespace App\controller;

    use PDO;
    use App\core\DataBase;
    use App\core\Controller;
    use App\controller\Template\Template;
    use App\model\CursosModel;

    class IndexController extends Controller implements Template {

        private PDO $conexao;
        private CursosModel $cursos;

        public function __construct()
        {
            $this->conexao = DataBase::estabelecerConexaoMySQL();
            $this->cursos  = new CursosModel($this->conexao);
        }

        public function index()
        {
            $this->carregarView('index');    
        }

        public function consultarCursos(string $titulo_formacao = '')
        {
            $arrayCursos = $this->cursos->consultarCursos($titulo_formacao);
            print(json_encode($arrayCursos));
        }

        public function buscarCursoPorNome(string $nome_curso)
        {
            $arrayCursos = $this->cursos->buscarCursoPorNome($nome_curso);
            print(json_encode($arrayCursos));
        }

        public function editarStatusCurso()
        {
            $input = file_get_contents('php://input');
            $dados = json_decode($input, true);
            extract($dados);

            $novoStatusCurso = !$novoStatusCurso;

            $retorno = $this->cursos->editarStatusCurso($idCurso, $novoStatusCurso);
            print(json_encode($retorno));
        }

    }