<?php

class WantController extends Controller
{
    private $models;

    public function __construct($application)
    {
        parent::__construct($application);
        $this->models['want'] = $this->dbManager->getModel('Want');
    }

    public function index()
    {
        $user_id = 1; // 仮のユーザーID
        $wants = $this->models['want']->getWantsPerUser($user_id);
        $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
        return $this->render([
            'pageTitle' => 'トップ',
            'checkTodayWant' => $checkTodayWant,
            'user_id' => $user_id,
            'wants' => $wants,
            'errors' => [],
        ]);
    }

    public function create()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $errors = [];

        $user_id = 1; // 仮のユーザーID
        $wantText = $_POST['want'];
        $errors = $this->validation->validateWant($wantText);

        if (count($errors) === 0) {
            $this->models['want']->createWant($user_id, $wantText);
        }

        $wants = $this->models['want']->getWantsPerUser($user_id);
        $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
        return $this->render([
                'pageTitle' => 'トップ',
                'checkTodayWant' => $checkTodayWant,
                'user_id' => $user_id,
                'wants' => $wants,
                'errors' => $errors,
            ], 'index');
    }

    public function update()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $wantId = $_POST['id'];
        $want = $this->models['want']->getWantById($wantId);
        return $this->render([
            'pageTitle' => '編集ページ',
            'want' => $want,
            'errors' => [],
        ], 'update');
    }

    public function updateAction()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $wantId = $_POST['id'];
        $wantText = $_POST['want'];

        $params = [];
        $redirectPage = 'index';
        $errors = [];
        $errors = $this->validation->validateWant($wantText);

        if (count($errors) === 0) {
            $this->models['want']->updateWantData($wantId, 'want', $wantText);
            $user_id = 1; // 仮のユーザーID
            $wants = $this->models['want']->getWantsPerUser($user_id);
            $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
            $params['pageTitle'] = 'トップ';
            $params['checkTodayWant'] = $checkTodayWant;
            $params['user_id'] = $user_id;
            $params['wants'] = $wants;
            $params['errors'] = [];
        } else {
            $redirectPage = 'update';
            $want = $this->models['want']->getWantById($wantId);
            $params['pageTitle'] = '編集ページ';
            $params['want'] = $want;
            $params['errors'] = $errors;
        }
        return $this->render($params, $redirectPage);
    }

    public function delete()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $wantId = $_POST['id'];
        $this->models['want']->deleteWant($wantId);

        $user_id = 1; // 仮のユーザーID
        $wants = $this->models['want']->getWantsPerUser($user_id);
        $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
        return $this->render([
                'pageTitle' => 'トップ',
                'checkTodayWant' => $checkTodayWant,
                'user_id' => $user_id,
                'wants' => $wants,
                'errors' => [],
            ], 'index');
    }

    public function switchAchievedWant()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $wantId = $_POST['id'];
        $achievedWant = $this->models['want']->getWantById($wantId)['achieved_want'];

        if ($achievedWant === 0) {
            $this->models['want']->updateWantData($wantId, 'achieved_want', 1);
        } else {
            $this->models['want']->updateWantData($wantId, 'achieved_want', 0);
        }

        $user_id = 1; // 仮のユーザーID
        $wants = $this->models['want']->getWantsPerUser($user_id);
        $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
        return $this->render([
                'pageTitle' => 'トップ',
                'checkTodayWant' => $checkTodayWant,
                'user_id' => $user_id,
                'wants' => $wants,
                'errors' => [],
            ], 'index');
    }
}
