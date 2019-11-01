<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

try {
    /**
     * Make IOC container using laravel Container Package
     */
    $container = \Illuminate\Container\Container::getInstance();

    /**
     * Create Application Instance and Contain to Laravel Container
     */
    $app = $container->make(\Pool\App::class);
    $app->init();

} catch (Exception $e) {
    echo $e->getMessage();
}
