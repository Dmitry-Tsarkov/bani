<?php

namespace app\modules\calculator\UI\admin\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\searchModels\CalculatorSearch;
use yii\data\ActiveDataProvider;

class CalculatorController extends ApiController
{
    public function actionIndex()
    {
//        $query = Calculator::find()
//            ->orderBy('position');
//
//        $dataProvider = new ActiveDataProvider(['query' => $query]);
//
//        return $this->render('menu', compact('dataProvider', 'type'))
    }
}