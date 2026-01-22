<?php

class WantController extends Controller
{
    public function index()
    {
        return $this->render([
            'pageTitle' => 'トップ画面',
        ]);
    }
}
