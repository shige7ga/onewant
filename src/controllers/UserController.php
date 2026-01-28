<?php

class UserController extends Controller
{
    private $models;

    public function __construct($application)
    {
        parent::__construct($application);
        $this->models['user'] = $this->dbManager->getModel('User');
    }

    public function signup()
    {
        return $this->render([
            'pageTitle' => 'トップ - ユーザ登録・ログイン',
        ]);
    }

    public function signupAction()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $this->models['user']->createUsers($username, $email, $password);
        return $this->render([
            'pageTitle' => 'トップ - ユーザ登録・ログイン',
        ], 'index');
    }
}
