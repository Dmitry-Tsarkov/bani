<?php

namespace app\modules\product\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\characteristic\models\Characteristic;
use app\modules\product\forms\RequestValueForm;
use app\modules\product\forms\ValueForm;
use app\modules\product\models\Product;
use app\modules\product\services\ProductService;
use DomainException;
use RuntimeException;
use Yii;

class ValueController extends BalletController
{
    public $service;

    public function __construct($id, $module, ProductService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionRequest($id)
    {
        $product = Product::getOrFail($id);
        $requestForm = new RequestValueForm($product);

        if ($requestForm->load(Yii::$app->request->post()) && $requestForm->validate()) {
            return $this->redirect(['set', 'id' => $product->id, 'characteristicId' => $requestForm->characteristic_id]);
        }
        return $this->render('request', compact('requestForm', 'product'));
    }

    public function actionSet($id, $characteristicId)
    {
        $product = Product::getOrFail($id);
        $characteristic = Characteristic::getOrFail($characteristicId);
        $valueForm = new ValueForm($characteristic, $product);

        if ($valueForm->load(Yii::$app->request->post()) && $valueForm->validate()) {
            try {
                $this->service->setValue($product->id, $characteristic->id, $valueForm);
                Yii::$app->session->setFlash('success', 'Значение добавлено');
                return $this->redirect(['product/view', 'id' => $product->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('success', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('success', $e->getMessage());
            }
        }

        return $this->render('set', compact('product', 'valueForm'));
    }

    public function actionDelete($productId, $valueId)
    {
        try {
            $this->service->deleteValue($productId, $valueId);
        } catch (RuntimeException $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }
}
