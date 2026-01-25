<?php

class WantController extends Controller
{
    private $model;

    public function __construct($application)
    {
        parent::__construct($application);
        $this->model = $this->dbManager->getModel('Want');
    }

    public function index()
    {
        $wants = $this->model->getAllWants();
        return $this->render([
            'pageTitle' => 'トップ画面',
            'wants' => $wants
        ]);
    }
}
