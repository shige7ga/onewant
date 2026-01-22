<?php

require_once __DIR__ . '/View.php';

class Controller
{
    private $actionName;

    public function run($action)
    {
        $this->actionName = $action;
        return $this->$action();
    }

    public function render($params = [], $actionName = null, $layout = 'layout')
    {
        if (is_null($actionName)) {
            $actionName = $this->actionName;
        }
        $controllerName = strtolower(str_replace('Controller', '', get_class($this)));
        $view = new View($controllerName . '/' . $actionName);
        return $view->render($params, $layout);
    }
}
