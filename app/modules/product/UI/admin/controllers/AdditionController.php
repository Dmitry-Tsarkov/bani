<?php

namespace app\modules\product\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\product\models\Addition;
use app\modules\product\models\Product;
use Yii;

class AdditionController extends BalletController
{
    public function actionCreate($productId)
    {
        $product = Product::getOrFail($productId);
        $addition = new Addition(['product_id' => $product->id]);

        if ($addition->load(Yii::$app->request->post()) && $addition->save()) {
            Yii::$app->session->setFlash('success', 'Параметр добавлен');
            return $this->redirect(['addition/update', 'productId' => $product->id, 'additionId' => $addition->id,]);
        }

        return $this->render('create', compact('addition', 'product'));
    }

    public function actionDelete($productId, $valueId)
    {
        $product = Product::getOrFail($productId);
        $addition = Addition::getOrFail($valueId);

        if ($addition->delete()) {
            Yii::$app->session->setFlash('success', 'Параметр удален');
            return $this->redirect(['product/view', 'id' => $product->id]);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate($additionId, $productId)
    {
        $addition = Addition::getOrFail($additionId);
        $product = Product::getOrFail($productId);

        if ($addition->load(Yii::$app->request->post()) && $addition->save()) {
            Yii::$app->session->setFlash('success', 'Параметр обновлен');
            return $this->refresh();
        }

        return $this->render('update', compact('addition', 'product'));
    }
}