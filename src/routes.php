<?php

$router->addRoute('GET', '/', 'Home@main');


// GET PARAMS FROM POST
$router->addRoute('POST', '/api/token', 'Home@main');