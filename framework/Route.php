<?php

namespace App\Framework;

class Route
{
    private $path = '/';
    private $controller;
    private $name;
    private $attributes = [];
    private $finalAttributes = [];
    private $host = '';
    private $schemes = [];
    private $methods = [];
    private $defaults = [];
    private $requirements = [];
    private $options = [];
    private $condition = '';

    /**
     * Undocumented function
     *
     * @param [type] $path
     * @param [type] $controller
     * @param [type] $name
     * @param [type] $methods
     */
    public function __construct($path, $controller, $name, $methods)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->name = $name;
        $this->methods = $methods;

        $this->checkAttributes();
    }

    public function checkAttributes()
    {
        $pos = strpos($this->path, "{");
        $path = $this->path;
        if (is_int($pos)) {
            $this->path = substr($this->path, 0, $pos - 1);
            //Maintenant qu'on a tous les attributes, il faut les ajouter à l'url mais faut d'abord récupérer la valeur directement depuis le controller
            //var_dump($this->path);
            //$this->path = $this->path . "/18";

            $path = substr($path, $pos);

            $this->sortAttributes($path);
        }
    }

    public function sortAttributes($path)
    {
        $attributes = explode("/", $path);

        foreach ($attributes as $attribute) {
            $this->attributes[] = substr($attribute, 1, -1);
        }
    }

    public function setAttributes($attributes)
    {
        for ($i = 0; $i < count($attributes); $i++) {
            $this->finalAttributes[$this->attributes[$i]] = $attributes[$i];
            $this->attributes[$i] = $attributes[$i];
        }

        $this->changePath();
    }

    public function changePath()
    {
        for ($i = 0; $i < count($this->attributes); $i++) {
            $this->path .= "/" . $this->attributes[$i];
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getFinalAttributes()
    {
        return $this->finalAttributes;
    }
}
