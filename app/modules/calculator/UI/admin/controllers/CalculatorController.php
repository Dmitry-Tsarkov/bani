<?php

namespace app\modules\calculator\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\searchModels\CalculatorSearch;
use app\modules\calculator\services\CalculatorService;
use Yii;

class CalculatorController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new CalculatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView($id)
    {
        $calculator = Calculator::getOrFail($id);

        return $this->render('view', compact('calculator'));
    }

    public function actionCreate()
    {
        $calculator = new Calculator();

        if ($calculator->load(Yii::$app->request->post()) && $calculator->save()) {
            Yii::$app->session->setFlash('success', 'Калькулятор создан');

            return $this->redirect(['view', 'id' => $calculator->id]);
        }

        return $this->render('create', compact('calculator'));
    }

    public function actionUpdate($id)
    {
        $calculator = Calculator::getOrFail($id);

        if ($calculator->load(Yii::$app->request->post()) && $calculator->save()) {

            Yii::$app->session->setFlash('success', 'Калькулятор обновлен');
            return $this->refresh();
        }

        return $this->render('update', compact('calculator'));
    }

    public function actionDelete($id)
    {
        Calculator::getOrFail($id)->delete();

        return $this->redirect(['index']);
    }
}