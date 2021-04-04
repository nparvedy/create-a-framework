<?php

use App\Framework\Router;

$router = new Router;

$router->register("/test/{name}/{age}/{test}", "App\Controller\TestController", "test", "GET");
$router->register("/", "App\Controller\TestController", "index", "GET");
