<?php

require dirname(__DIR__) . '/framework/Autoload.php';
require dirname(__DIR__) . '/routes/routes.php';

$response = $router->getRoute();

$response->send();
