<?php

    namespace App\controller;

    use App\core\Controller;
    use App\controller\Template\Template;

    class IndexController extends Controller implements Template {

        public function index()
        {
            $this->carregarView('index');
            
        }

    }