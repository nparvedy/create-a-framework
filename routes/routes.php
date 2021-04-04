<?php

use App\Framework\Router;

$router = new Router;
//$router->register(["path" => "/", "controller" => "App\Controller\TestController", "name" => "index", "methods" => "GET"]);
$router->register("/test/{name}/{age}/{test}", "App\Controller\TestController", "test", "GET");
$router->register("/", "App\Controller\TestController", "index", "GET");

//D'abord on crée la route

//Après on ajoute la route dans la RouteCollection

//Et après on appel la bonne route qui est dans la RouteCollection grâce au routeur
