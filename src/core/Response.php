<?php

class Response
{
    private $content;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function send()
    {
        echo $this->content;
    }
}
