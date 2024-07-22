<?php

    namespace App\core;

    class Controller {

        protected function carregarView(string $nomeView, array $arrayParametrosView = array())
        {
            extract($arrayParametrosView);
            include("App/view/{$nomeView}.php");
        }

    }