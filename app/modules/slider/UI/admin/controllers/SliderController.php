<?php

namespace app\modules\slider\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\slider\models\Slide;
use app\modules\slider\searchModels\SlideSearch;
use Yii;
use yii\web\Response;

class SliderController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new SlideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $slide = new Slide();

        if ($slide->load(Yii::$app->request->post()) && $slide->save()) {
            Yii::$app->session->setFlash('success', 'Акция добавлена');
            return $this->redirect(['update', 'id' => $slide->id]);
        }

        return $this->render('create', compact('slide'));
    }

    public function actionDeleteImage($id)
    {
        $client = Slide::getOrFail($id);
        $client->deleteImage();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionUpdate($id)
    {
        $slide = Slide::getOrFail($id);

        if ($slide->load(Yii::$app->request->post()) && $slide->save()) {
            Yii::$app->session->setFlash('success', 'Слайд обновлен');
            return $this->refresh();
        }

        return $this->render('update', compact('slide'));
    }

    public function actionDelete($id)
    {
        $slide = Slide::getOrFail($id);
        if ($slide->delete()) {
            Yii::$app->session->setFlash('success', 'Слайд удален');
            return $this->redirect(['index']);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMoveUp($id)
    {
        Slide::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Slide::getOrFail($id)->moveNext();
    }
}
