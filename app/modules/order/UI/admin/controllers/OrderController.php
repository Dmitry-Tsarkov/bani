<?php

namespace app\modules\order\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\order\models\Order;
use app\modules\order\searchModels\OrderSearch;
use app\modules\order\services\services\OrderManageService;
use DomainException;
use Yii;

class OrderController extends BalletController
{
    /**
     * @var OrderManageService
     */

    private $service;

    public function __construct($id, $module, OrderManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionProduct()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView($id)
    {
        $order = Order::getOrFail($id);
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('modal', compact('order'));
        }
        return $this->render('view', compact('order'));
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