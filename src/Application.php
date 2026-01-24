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
        try {
            $params = $this->router->resolve($this->request->getPath());
            if (!$params) {
                throw new HttpNotFoundPageException();
            }
            $controllerClass = ucfirst($params['controller']) . 'Controller';
            if (!class_exists($controllerClass)) {
                throw new HttpNotFoundPageException();
            }
            $action = $params['action'];
            $controller = new $controllerClass();
            $content = $controller->run($action);
            $this->response->setContent($content);
        } catch (HttpNotFoundPageException) {
            $this->handleNotFound();
        }
        $this->response->send();
    }

    private function registerRoutes()
    {
        return [
            '/' => ['controller' => 'want', 'action' => 'index'],
        ];
    }

    private function handleNotFound()
    {
        $this->response->setStatusCode(404);
        $this->response->setStatusText('Not Found');
        $view = new View('notFound');
        $content = $view->renderNotFound();
        $this->response->setContent($content);
    }
}
