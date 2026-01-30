<?php

class UserController extends Controller
{
    private $models;

    public function __construct($application)
    {
        parent::__construct($application);
        $this->models['user'] = $this->dbManager->getModel('User');
        $this->models['want'] = $this->dbManager->getModel('Want');
    }

    public function signup()
    {
        return $this->render([
            'pageTitle' => 'トップ - ユーザ登録・ログイン',
        ]);
    }

    public function signupAction()
    {
        session_start();
        session_regenerate_id(true);

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $signupUser = $this->models['user']->createUsers($username, $email, $password);

        $_SESSION['user_id'] = $signupUser['user_id'];

        $wants = $this->models['want']->getWantsPerUser($_SESSION['user_id']);
        $checkTodayWant = $this->models['want']->checkTodayWant($_SESSION['user_id']);

        return $this->render([
            'pageTitle' => 'トップ - ユーザ登録・ログイン',
            'checkTodayWant' => $checkTodayWant,
            'user_id' => $_SESSION['user_id'],
            'wants' => $wants,
            'errors' => [],
        ], 'index');
    }

    public function logout()
    {
        session_start();

        // セッション情報を空にする
        $_SESSION = [];

        // クッキーも消す（セッションIDの無効化）
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        // セッション破棄
        session_destroy();

        return $this->render([
            'pageTitle' => 'トップ - ユーザ登録・ログイン',
        ], 'signup');
    }
}
