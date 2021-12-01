<?php

namespace app\modules\calculator\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\searchModels\CalculatorSearch;
use app\modules\calculator\services\CalculatorService;
use DomainException;
use app\modules\calculator\forms\CalculatorForm;
use Exception;
use RuntimeException;
use Yii;
use yii\web\Response;

class CalculatorController extends BalletController
{
    private $service;

    public function __construct($id, $module, CalculatorService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }


    public function actionIndex()
    {
        $searchModel = new CalculatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView($id)
    {
        $calculator = Calculator::getOrFail($id);

        return $this->render('view', compact('calculator'));
    }

    public function actionCreate()
    {
        $createForm = new CalculatorForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $characteristic = $this->service->create($createForm);
                Yii::$app->session->setFlash('success', 'Калькулятор добавлен');
                return $this->redirect(['view', 'id' => $characteristic->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('create', compact('createForm'));
    }
    public function actionUpdate($id)
    {
        $calculator = Calculator::getOrFail($id);
        $editForm = new CalculatorForm($calculator);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                $this->service->edit($calculator->id, $editForm);
                Yii::$app->session->setFlash('success', 'Калькулятор изменен');
                return $this->refresh();
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', compact('kit', 'editForm'));
    }

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

    public function actionDeleteImage($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->deleteImage($id);
            return [];
        } catch (DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (RuntimeException $e) {
            Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }
}