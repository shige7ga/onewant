<?php

class Request
{
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function getPath()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
