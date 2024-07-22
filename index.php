<?php

    require 'vendor/autoload.php';
    require 'config/config.php';
    require 'App/core/Core.php';

    $core = new Core;
    $core->executarMVC();