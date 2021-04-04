<?php

// class testa
// {
//     public function test($a)
//     {
//     }
// }

// $fct = new ReflectionMethod('testa', 'test');
// $num = $fct->getNumberOfParameters();
// var_dump($num);


require dirname(__DIR__) . '/framework/Autoload.php';
require dirname(__DIR__) . '/routes/routes.php';

$response = $router->getRoute();

$response->send();
