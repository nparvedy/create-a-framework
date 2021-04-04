<?php

namespace App\Framework;

class Response
{
    protected string $content;

    public function __construct(?string $content = '', int $status = 200, array $headers = [])
    {
        $this->setContent($content);
    }

    public function setContent($content)
    {
        $this->content = $content ?? '';
    }

    public function sendContent()
    {
        echo $this->content;
    }

    public function send()
    {
        $this->sendContent();
        return $this;
    }
}
