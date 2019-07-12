<?php

$router->addRoute('GET', '/', 'Home@main');


// GET PARAMS FROM POST
$router->addRoute('GET', '/api/token', 'Api@token');
$router->addRoute('GET', '/api/movies', 'Api@movies');