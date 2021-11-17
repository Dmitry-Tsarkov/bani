<?php

namespace app\modules\kit\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\kit\models\Kit;
use app\modules\kit\searchModels\KitSearch;
use Yii;

class KitController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new KitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }


    public function actionCreate()
    {
        $kit = new Kit();

        if ($kit->load(Yii::$app->request->post()) && $kit->save()) {
            Yii::$app->session->setFlash('success', 'Комплект добавлен');
            return $this->redirect(['update', 'id' => $kit->id]);
        }

        return $this->render('create', compact('kit'));
    }

    public function actionUpdate($id)
    {
        $kit = Kit::getOrFail($id);

        if ($kit->load(Yii::$app->request->post()) && $kit->save()) {
            Yii::$app->session->setFlash('success', 'Комплект обновлен');
            return $this->refresh();
        }

        return $this->render('update', compact('kit'));
    }

    public function actionDelete($id)
    {
        $kit = Kit::getOrFail($id);
        if ($kit->delete()) {
            Yii::$app->session->setFlash('success', 'Комплект удален');
            return $this->redirect(['index']);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}