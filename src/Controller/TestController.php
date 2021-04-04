<?php

namespace App\Controller;

use App\Method\Calcul;
use App\Framework\Response;

class TestController
{
    public function index()
    {
        return new Response("Je suis la page index");
    }

    public function test(array $attributes, Calcul $calcul)
    {
        $resultat = $calcul->calcul(3, 4);
        return new Response("Bonjour {$attributes['name']}, tu as {$attributes['age']}, et ceci est la page de {$attributes['test']} ! Le resultat du calcul est :" . $resultat);
    }
}
