<?php

class Application
{
    private $router;
    private $request;
    private $response;
    private $dbManager;

    public function __construct()
    {
        $this->router = new Router($this->registerRoutes());
        $this->request = new Request();
        $this->response = new Response();
        $this->dbManager = new DbManager();
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
            $controller = new $controllerClass($this);
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
            '/create' => ['controller' => 'want', 'action' => 'create'],
            '/update' => ['controller' => 'want', 'action' => 'update'],
            '/update/action' => ['controller' => 'want', 'action' => 'updateAction'],
            '/delete' => ['controller' => 'want', 'action' => 'delete'],
            '/switchAchievedWant' => ['controller' => 'want', 'action' => 'switchAchievedWant'],
            '/signup' => ['controller' => 'user', 'action' => 'signup'],
            '/signup/action' => ['controller' => 'user', 'action' => 'signupAction'],
            '/logout' => ['controller' => 'user', 'action' => 'logout'],
        ];
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getDbManager()
    {
        return $this->dbManager;
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
