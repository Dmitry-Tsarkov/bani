<?php

namespace app\modules\calculator\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\calculator\forms\CalculatorCharacteristicForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\services\CalculatorCharacteristicService;
use app\modules\characteristic\models\Characteristic;
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

    public function actionCreate($id)
    {
        $calculator = Calculator::getOrFail($id);
        $createForm = new CalculatorCharacteristicForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $this->service->create($createForm, $calculator);
                Yii::$app->session->setFlash('success', 'Характеристика добавлена');
                return $this->redirect(['calculator/view', 'id' => $calculator->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('create', compact('createForm', 'calculator'));
    }

    public function actionDelete($valueId)
    {
        $characteristic = CalculatorCharacteristc::getOrFail($valueId);

        try {
            $this->service->delete($characteristic->id);
            Yii::$app->session->setFlash('success', 'Характеристика успешно удалена');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['index']);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}