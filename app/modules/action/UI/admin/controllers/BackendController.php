<?php


namespace app\modules\action\UI\admin\controllers;


use app\modules\action\models\Action;
use app\modules\action\searchModels\ActionSearch;
use app\modules\admin\components\BalletController;
use Yii;
use yii\helpers\VarDumper;

class BackendController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new ActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionCreate()
    {
        $action = new Action();
        if ($action->load(Yii::$app->request->post()) && $action->save()) {
            Yii::$app->session->setFlash('success', 'Акция добавлена');
            return $this->redirect(['update', 'id' => $action->id]);
        }
        return $this->render('create', compact('action'));
    }

    public function actionUpdate($id)
    {
        $action = Action::getOrFail($id);
        if ($action->load(Yii::$app->request->post()) && $action->save()) {
            Yii::$app->session->setFlash('success', 'Обновлено');
            return $this->refresh();
        }

        return $this->render('update', compact('action'));
    }

    public function actionDelete($id)
    {
        $action = Action::getOrFail($id);

        if ($action->status != Action::STATUS_ACTIVE) {
            if ($action->delete()) {
                Yii::$app->session->setFlash('success', 'Акция удалена');
                return $this->redirect(['index']);
            }
        }
        Yii::$app->session->setFlash('danger', 'Нельзя удалить действующую акцию');


        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteImage($id)
    {
        Action::getOrFail($id)->deleteImage();
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionMoveUp($id)
    {
        Action::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Action::getOrFail($id)->moveNext();
    }
}