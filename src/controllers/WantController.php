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
            'wants' => $wants
        ]);
    }

    public function create()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $user_id = 1; // 仮のユーザーID
        $wantText = $_POST['want'];
        $this->models['want']->createWant($user_id, $wantText);
        $wants = $this->models['want']->getWantsPerUser($user_id);
        $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
        return $this->render([
                'pageTitle' => 'トップ',
                'checkTodayWant' => $checkTodayWant,
                'user_id' => $user_id,
                'wants' => $wants
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
            'want' => $want
        ], 'update');
    }

    public function updateAction()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $wantId = $_POST['id'];
        $wantText = $_POST['want'];
        $this->models['want']->updateWantData($wantId, 'want', $wantText);

        $user_id = 1; // 仮のユーザーID
        $wants = $this->models['want']->getWantsPerUser($user_id);
        $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
        return $this->render([
                'pageTitle' => 'トップ',
                'checkTodayWant' => $checkTodayWant,
                'user_id' => $user_id,
                'wants' => $wants
            ], 'index');
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
                'wants' => $wants
            ], 'index');
    }

    public function achieve()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $wantId = $_POST['id'];
        $this->models['want']->updateWantData($wantId, 'achieved_want', 1);

        $user_id = 1; // 仮のユーザーID
        $wants = $this->models['want']->getWantsPerUser($user_id);
        $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
        return $this->render([
                'pageTitle' => 'トップ',
                'checkTodayWant' => $checkTodayWant,
                'user_id' => $user_id,
                'wants' => $wants
            ], 'index');
    }

    public function notAchieve()
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundPageException();
        }
        $wantId = $_POST['id'];
        $this->models['want']->updateWantData($wantId, 'achieved_want', 0);

        $user_id = 1; // 仮のユーザーID
        $wants = $this->models['want']->getWantsPerUser($user_id);
        $checkTodayWant = $this->models['want']->checkTodayWant($user_id);
        return $this->render([
                'pageTitle' => 'トップ',
                'checkTodayWant' => $checkTodayWant,
                'user_id' => $user_id,
                'wants' => $wants
            ], 'index');
    }
}
