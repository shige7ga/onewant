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
        require __DIR__ . '/../views/' . $this->path . '.php';
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . '/../views/layouts/' . $layout . '.php';
        return ob_get_clean();
    }

    public function renderNotFound()
    {
        ob_start();
        require __DIR__ . '/../views/notFound.php';
        return ob_get_clean();
    }
}
