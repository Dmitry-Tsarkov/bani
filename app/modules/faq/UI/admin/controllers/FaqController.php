<?php

namespace app\modules\faq\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\faq\models\Faq;
use app\modules\faq\searchModels\FaqSearch;
use Yii;

class FaqController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }


    public function actionCreate()
    {
        $faq = new Faq();

        if ($faq->load(Yii::$app->request->post()) && $faq->save()) {
            Yii::$app->session->setFlash('success', 'Вопрос добавлен');
            return $this->redirect(['update', 'id' => $faq->id]);
        }

        return $this->render('create', compact('faq'));
    }

    public function actionUpdate($id)
    {
        $faq = Faq::getOrFail($id);

        if ($faq->load(Yii::$app->request->post()) && $faq->save()) {
            Yii::$app->session->setFlash('success', 'Вопрос-ответ обновлен');
            return $this->refresh();
        }

        return $this->render('update', compact('faq'));
    }

    public function actionDelete($id)
    {
        $faq = Faq::getOrFail($id);
        if ($faq->delete()) {
            Yii::$app->session->setFlash('success', 'Вопрос-ответ удален');
            return $this->redirect(['index']);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMoveUp($id)
    {
        Faq::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Faq::getOrFail($id)->moveNext();
    }
}
