<?php

    require 'vendor/autoload.php';
    require 'config/config.php';

    use App\core\Core;

    $core = new Core;
    $core->executarMVC();