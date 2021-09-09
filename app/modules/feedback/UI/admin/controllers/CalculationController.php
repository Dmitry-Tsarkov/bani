<?php

namespace app\modules\feedback\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\feedback\models\Feedback;
use app\modules\feedback\searchModel\FeedbackCalculationSearch;
use app\modules\feedback\services\manage\FeedbackManageService;
use DomainException;
use Yii;

class CalculationController extends BalletController
{
    /**
     * @var FeedbackManageService
     */

    private $service;

    public function __construct($id, $module, FeedbackManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $searchModel = new FeedbackCalculationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView($id)
    {
        $feedback = Feedback::getOrFail($id);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('modal', compact('feedback'));
        }
        return $this->render('view', compact('feedback'));
    }

    public function actionChangeStatus($id, $status)
    {
        try {
            $this->service->changeStatus($id, $status);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}