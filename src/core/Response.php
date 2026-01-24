<?php

class Response
{
    private $content;
    private $statusCode;
    private $statusText;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    public function setStatusText($text)
    {
        $this->statusText = $text;
    }

    public function send()
    {
        header("HTTP/1.1 {$this->statusCode} {$this->statusText}");
        echo $this->content;
    }
}
