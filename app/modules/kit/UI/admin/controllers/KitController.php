<?php

namespace app\modules\kit\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\kit\forms\KitForm;
use app\modules\kit\models\Kit;
use app\modules\kit\searchModels\KitSearch;
use app\modules\kit\services\KitService;
use DomainException;
use Exception;
use RuntimeException;
use Yii;
use yii\helpers\VarDumper;

class KitController extends BalletController
{
    private $service;

    public function __construct($id, $module, KitService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $searchModel = new KitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $kitForm = new KitForm();

        if ($kitForm->load(Yii::$app->request->post()) && $kitForm->validate()) {
            try {
                $kit = $this->service->create($kitForm);
                Yii::$app->session->setFlash('success', 'Комплект добавлен');
                return $this->redirect(['update', 'id' => $kit->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', compact( 'kitForm'));
    }

    public function actionUpdate($id)
    {
        $kit = Kit::getOrFail($id);
        $kitForm = new KitForm($kit);

        if ($kitForm->load(Yii::$app->request->post()) && $kitForm->validate()) {
            try {
                $this->service->edit($kit->id, $kitForm);
                Yii::$app->session->setFlash('success', 'Комплект изменен');
                return $this->refresh();
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', compact('kit', 'kitForm'));
    }

    public function actionDelete($id)
    {
        $kit = Kit::getOrFail($id);

        try {
            $this->service->delete($kit->id);
            Yii::$app->session->setFlash('success', 'Комплект успешно удален');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['index']);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}