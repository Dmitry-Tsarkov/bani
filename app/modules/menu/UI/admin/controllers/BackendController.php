<?php

namespace app\modules\menu\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\menu\models\MenuItem;
use Yii;
use yii\data\ActiveDataProvider;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $query = MenuItem::find()
            ->orderBy('position');

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate()
    {
        $menuItem = new MenuItem();
        if ($menuItem->load(Yii::$app->request->post()) && $menuItem->save()) {
            Yii::$app->session->setFlash('success', 'Заголовок добавлен');
            return $this->redirect(['index']);
        }
        return $this->render('create', compact('menuItem'));
    }

    public function actionUpdate($id)
    {
        $menuItem = MenuItem::getOrFail($id);
        if ($menuItem->load(Yii::$app->request->post()) && $menuItem->save()) {
            Yii::$app->session->setFlash('success', 'Обновлено');
            return $this->redirect(['index']);
        }

        return $this->render('update', compact('menuItem'));
    }

    public function actionDelete($id)
    {
        $menuItem = MenuItem::getOrFail($id);

        if ($menuItem->delete()) {
            Yii::$app->session->setFlash('success', 'Заголовок удален');
            return $this->redirect(['/admin/menu/']);
        }
        Yii::$app->session->setFlash('danger', 'Нельзя удалить заголовок');

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMoveUp($id)
    {
        MenuItem::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        MenuItem::getOrFail($id)->moveNext();
    }
}