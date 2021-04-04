<?php

namespace App\Framework;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use App\Framework\Route;
use App\Framework\Request;
use App\Framework\RouteCollection;

class Router
{

    protected array $routes = [];
    protected string $uri;
    protected Request $requestMethod;
    protected RouteCollection $routeCollection;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->requestMethod = new Request($_SERVER['REQUEST_METHOD']);
        $this->routeCollection = new RouteCollection;
    }

    /**
     * Undocumented function
     *
     * @param [type] $path Le chemin de la route
     * @param [type] $controller Le controller appelé
     * @param [type] $name Le nom de la méthode du controller
     * @param [type] $methods GET OR POST
     * @return void
     */
    public function register($path, $controller, $name, $methods)
    {
        $this->routeCollection->add(new Route($path, $controller, $name, $methods));

        //$this->routes[] = $route;
    }

    public function getRoute()
    {
        $route = $this->foundRoute();

        if (method_exists($route, "methods")) {
            if ($route->getMethods != $this->requestMethod->getRequestMethod()) {
                return new Response("Désolé vous ne pouvez pas acceder à la page");
            }
        }

        if ($route != null) {
            $controller = $route->getController();
            $controller = new $controller();
            $name = $route->getName();

            if (empty($route->getAttributes())) {
                return $controller->$name();
            } else {
                if (empty($route->getFinalAttributes())) {
                    return new Response("Manque d'argument");
                }
                $fct = new ReflectionMethod($route->getController(), $name);
                $num = $fct->getNumberOfParameters();
                $typePara = $fct->getParameters();

                $functionName = ucFirst($typePara[1]->getName());

                //$reflectionClass = new ReflectionClass($route->getController());

                //faire en sorte qu'on est pas obligé d'ajouter \App\Method\\ pour l'injection de dépendance et si possible d'en avoir plusieurs

                $functionName = '\App\Method\\' . $functionName;

                if ($num >= 2) {

                    return $controller->$name($route->getFinalAttributes(), new $functionName);
                }

                return $controller->$name($route->getFinalAttributes());
                //$controller = $route->getController();
            }
        }


        return new Response("Désolé la page demandée n'est pas disponible");
    }

    public function foundRoute()
    {
        //Si la route contient le début de la route et si il la trouve mais pas en entier alors vérifier si il y a des attributes
        foreach ($this->routeCollection->getRouteCollection() as $value) {
            $pos = strpos($this->uri, $value->getPath());

            if (is_int($pos)) {
                if ($value->getPath() === $this->uri) {
                    return $value;
                } else {
                    $pos = strpos($this->uri, $value->getPath(), 1);
                    $path = substr($this->uri,  strlen($this->uri) - $pos + 1);
                    $attributes = explode("/", $path);

                    if (count($attributes) === count($value->getAttributes())) {
                        $value->setAttributes($attributes);

                        return $value;
                    }
                }
            }
        }
    }
}
