<?php

namespace app\modules\region\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\region\searchModels\RegionSearch;
use Yii;

class RegionController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new RegionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }
}