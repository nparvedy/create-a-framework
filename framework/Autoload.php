<?php

class Autoload
{
    public static function getLoader()
    {
        spl_autoload_register(function ($class) {
            $newRoute = self::checkNamespace($class);
            if ($newRoute != false) {
                require_once(dirname(__DIR__) . '/' . $newRoute . ".php");
            } else {
                echo "Désolé le namespace demandé n'existe pas";
            }
            //require_once 
        });
    }

    public static function checkNamespace($class)
    {
        $json = file_get_contents("../namespace.json");
        $json = json_decode($json, true);
        $json = $json["autoload"]["psr4"];
        foreach ($json as $key => $value) {
            $pos = strpos($class, $key);
            if (is_int($pos)) {
                $value = str_replace($key, $value, $class);
                return $value;
            }
        }
        return false;
    }
}

Autoload::getLoader();
