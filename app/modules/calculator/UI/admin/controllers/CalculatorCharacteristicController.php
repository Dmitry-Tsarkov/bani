<?php

namespace app\modules\calculator\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\calculator\forms\CalculatorCharacteristicValueForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\Calculator;
use DomainException;
use RuntimeException;
use Yii;

class CalculatorCharacteristicController extends BalletController
{
    public function actionView($calculatorId, $characteristicId)
    {
        $calculator = Calculator::getOrFail($calculatorId);
        $characteristic = CalculatorCharacteristc::getOrFail($characteristicId);
        return $this->render('view', compact('calculator', 'characteristic'));
    }


    public function actionSet($id, $characteristicId)
    {
//        $calculator = Calculator::getOrFail($id);
//        $characteristic = CalculatorCharacteristc::getOrFail($characteristicId);
//        $valueForm = new CalculatorCharacteristicValueForm($characteristic, $calculator);
//
//        if ($valueForm->load(Yii::$app->request->post()) && $valueForm->validate()) {
//            try {
//                $this->service->setValue($calculator->id, $characteristic->id, $valueForm);
//                Yii::$app->session->setFlash('success', 'Значение добавлено');
//                return $this->redirect(['product/view', 'id' => $calculator->id]);
//            } catch (DomainException $e) {
//                Yii::$app->session->setFlash('success', $e->getMessage());
//            } catch (RuntimeException $e) {
//                Yii::$app->errorHandler->logException($e);
//                Yii::$app->session->setFlash('success', $e->getMessage());
//            }
//        }
//
//        return $this->render('set', compact('calculator', 'valueForm'));
    }

    public function actionMoveUp($id)
    {
        CalculatorCharacteristc::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        CalculatorCharacteristc::getOrFail($id)->moveNext();
    }
}