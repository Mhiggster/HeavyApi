<?php
echo '<pre>';
if(isset($_SERVER['SERVER_NAME']))
{
    echo 'FROM BROWSER';
} else {
    echo 'FROM TERMINAL';
}
// require_once __DIR__ . '/vendor/autoload.php';

// try {
//     /*
//      * make Laravel Ioc container
//      * */
//     $container = \Illuminate\Container\Container::getInstance();

//     $app = $container->make(\Pool\App::class);


//     $app->taskRunner();
// } catch (Exception $e) {
//     echo $e->getMessage();
// }
