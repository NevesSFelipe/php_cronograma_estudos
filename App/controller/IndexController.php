<?php

    namespace App\controller;

    use App\core\Controller;
    use App\controller\Template\Template;
    use App\model\Cursos;

    class IndexController extends Controller implements Template {

        public function index()
        {
            $this->carregarView('index');    
        }

        public function consultarCursos($titulo_formacao = '')
        {
            $where = $titulo_formacao == '' ? '' : "titulo_formacao = '{$titulo_formacao}'";

            $cursos = new Cursos;
            $arrayCursos = $cursos->consultarCursos(condicaoWhere: $where);

            $data = array(
                'status' => 'success',
                'data' => $arrayCursos
            );

            header('Content-Type: application/json');
            print(json_encode($data));
        }

    }