<?php

namespace app\modules\calculator\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\calculator\forms\CalculatorCharacteristicForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\services\CalculatorCharacteristicService;
use DomainException;
use Exception;
use RuntimeException;
use Yii;

class CalculatorCharacteristicController extends BalletController
{
    private $service;

    public function __construct($id, $module, CalculatorCharacteristicService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionView($calculatorId, $characteristicId)
    {
        $calculator = Calculator::getOrFail($calculatorId);
        $characteristic = CalculatorCharacteristc::getOrFail($characteristicId);

        return $this->render('view', compact('calculator', 'characteristic'));
    }

    public function actionUpdate($calculatorId, $characteristicId)
    {
        $calculator = Calculator::getOrFail($calculatorId);
        $characteristic = CalculatorCharacteristc::getOrFail($characteristicId);
        $editForm = new CalculatorCharacteristicForm($characteristic);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                $this->service->edit($calculator->id, $editForm);
                Yii::$app->session->setFlash('success', 'Характеристика изменена');
                return $this->redirect([
                    'calculator-characteristic/view',
                    'calculatorId' => $calculator->id,
                    'characteristicId' => $characteristic->id
                ]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', compact('calculator', 'characteristic', 'editForm'));
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

//    public function actionMoveUp($id)
//    {
//        CalculatorCharacteristc::getOrFail($id)->movePrev();
//    }
//
//    public function actionMoveDown($id)
//    {
//        CalculatorCharacteristc::getOrFail($id)->moveNext();
//    }

    public function actionDelete($id)
    {
        $calculator = Calculator::getOrFail($id);

        try {
            $this->service->delete($calculator->id);
            Yii::$app->session->setFlash('success', 'Калькулятор успешно удален');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['index']);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}