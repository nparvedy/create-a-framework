<?php

namespace App\Controller;

use App\Framework\Response;

class TestController
{
    public function index()
    {
        return new Response("Je suis la page index");
    }

    public function test($attributes)
    {
        return new Response("Bonjour {$attributes['name']}, tu as {$attributes['age']}, et ceci est la page de {$attributes['test']} !");
    }
}
