<?php

namespace app\modules\regions\UI\admin\controllers;

use app\modules\admin\components\BalletController;

class RegionController extends BalletController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}