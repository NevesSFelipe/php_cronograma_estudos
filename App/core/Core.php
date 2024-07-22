<?php

    class Core {

        private string $controller;
        private string $metodo;
        private array $parametros = array();

        public function __construct()
        {
            $this->mapearUrl();
        }

        public function executarMVC()
        {
            $controller = new $this->controller;
            call_user_func_array(array($controller, $this->metodo), $this->parametros);
        }

        private function mapearUrl(): void
        {
            $url = explode("index.php", $_SERVER['PHP_SELF']);
            $url = end($url);

            if($url == "") {

                $urlDefault = array(CONTROLLER_DEFAULT, METODO_DEFAULT);

                $this->definirController($urlDefault);
                $this->definirMetodo($urlDefault);

                return;
            
            }

            $url = explode("/", $url);
            array_shift($url);

            $this->definirController($url);
            $this->definirMetodo($url);
            $this->definirParametros($url);

        }

        private function definirController(array &$url): void
        {
            $classeExiste = class_exists(NAMESPACE_DEFAULT . $url[0] . "Controller");

            $nomeController = $classeExiste === true ? $url[0] : CONTROLLER_DEFAULT;
            
            $this->controller = NAMESPACE_DEFAULT . ucfirst($nomeController) . "Controller";
                
            array_shift($url);
        }

        private function definirMetodo(array &$url): void
        {
            $metodoExiste = (
                empty($url[0]) === false &&
                method_exists($this->controller, $url[0])
            );

            $this->metodo = $metodoExiste === true ? $url[0] : METODO_DEFAULT;

            array_shift($url);
        }
        
        private function definirParametros(array &$url): void
        {
            $this->parametros = array_filter($url);
        }

    }