<?php

class Controller
{
    private $actionName;

    public function run($action)
    {
        $this->actionName = $action;
        return $this->$action();
    }
}
