<?php

class View
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render($params = [], $layout = 'layout')
    {
        extract($params);
        ob_start();
        include __DIR__ . '/../views/' . $this->path . '.php';
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../views/layouts/' . $layout . '.php';
        return ob_get_clean();
    }
}
