<?php

class Application
{
    private $router;
    private $request;
    private $response;

    public function __construct()
    {
        $this->router = new Router($this->registerRoutes());
        $this->request = new Request();
        $this->response = new Response();
    }

    public function run()
    {
        $params = $this->router->resolve($this->request->getPath());
        $controllerClass = ucfirst($params['controller']) . 'Controller';
        $action = $params['action'];
        $controller = new $controllerClass();
        $content = $controller->run($action);
        $this->response->setContent($content);
        $this->response->send();
    }

    private function registerRoutes()
    {
        return [
            '/' => ['controller' => 'want', 'action' => 'index'],
        ];
    }
}
