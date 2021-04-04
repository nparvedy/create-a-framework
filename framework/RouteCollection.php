<?php

namespace App\Framework;

use App\Framework\Route;

class RouteCollection
{
    private $routeCollection = [];

    public function add(Route $route)
    {
        $this->routeCollection[] = $route;
    }

    public function getRouteCollection()
    {
        return $this->routeCollection;
    }
}
