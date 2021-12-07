<?php

namespace app\modules\order\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\order\forms\massive\OrderMassiveDeleteForm;
use app\modules\order\forms\massive\OrderMassiveStatusForm;
use app\modules\order\models\Order;
use Yii;

class MassiveController extends BalletController
{
    public function actionStatus()
    {
        $form = new OrderMassiveStatusForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            Order::updateAll(['status' => $form->statusId], ['id' => $form->ids]);
        }
    }

    public function actionDelete()
    {
        $form = new OrderMassiveDeleteForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Order::deleteAll(['id' => $form->ids]);
        }
    }
}