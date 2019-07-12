<?php

require __DIR__ . '/vendor/autoload.php';

try {
    /*
     * make Laravel Ioc container
     * */
    $container = \Illuminate\Container\Container::getInstance();
    $app = $container->make(\Pool\App::class);

    $app->init();


} catch ( $e) {
    echo $e->getMessage();
}