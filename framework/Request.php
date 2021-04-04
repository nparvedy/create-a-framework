<?php

namespace App\Framework;

class Request
{

    private $requestMethod;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }
}
