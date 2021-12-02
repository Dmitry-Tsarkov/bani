<?php

namespace app\modules\calculator\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\calculator\forms\CalculatorValueForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\CalculatorValue;
use app\modules\calculator\services\CalculatorValueService;
use DomainException;
use Exception;
use RuntimeException;
use Yii;

class CalculatorValueController extends BalletController
{
    private $service;

    public function __construct($id, $module, CalculatorValueService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionCreate($id)
    {
        $characteristic = CalculatorCharacteristc::getOrFail($id);
        $createForm = new CalculatorValueForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $value = $this->service->create($createForm, $characteristic);
                Yii::$app->session->setFlash('success', 'Значение добавлено');
                return $this->redirect([
                    'calculator-characteristic/view',
                    'calculatorId' => $characteristic->calculator->id,
                    'characteristicId' => $characteristic->id,
                ]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('create', compact('createForm', 'characteristic'));
    }


    public function actionUpdate($characteristicId, $valueId)
    {
        $characteristic = CalculatorCharacteristc::getOrFail($characteristicId);
        $value = CalculatorValue::getOrFail($valueId);
        $editForm = new CalculatorValueForm($value);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                $this->service->edit($value->id, $editForm);
                Yii::$app->session->setFlash('success', 'Значение изменено');
                return $this->redirect([
                    'calculator-characteristic/view',
                    'calculatorId' => $characteristic->id,
                    'characteristicId' => $characteristic->id
                ]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', compact('characteristic', 'value', 'editForm'));
    }

    public function actionDelete($id)
    {
        $value = CalculatorValue::getOrFail($id);

        try {
            $this->service->delete($value->id);
            Yii::$app->session->setFlash('success', 'Значение успешно удалено');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['index']);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMoveUp($id)
    {
        CalculatorValue::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        CalculatorValue::getOrFail($id)->moveNext();
    }
}