<?php

namespace app\modules\service\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\service\forms\ServiceImagesForm;
use app\modules\service\forms\ServiceForm;
use app\modules\service\models\Service;
use app\modules\service\searchModel\ServiceSearch;
use app\modules\service\services\ServiceService;
use DomainException;
use Exception;
use RuntimeException;
use Yii;
use yii\web\Response;

class ServiceController extends BalletController
{
    private $service;

    public function __construct($id, $module, ServiceService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionView($id)
    {
        $service = Service::getOrFail($id);

        return $this->render('view', compact('service'));
    }

    public function actionUpdate($id)
    {
        $service = Service::getOrFail($id);
        $editForm = new ServiceForm($service);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                $this->service->edit($service->id, $editForm);
                Yii::$app->session->setFlash('success', 'Услуга изменена');
                return $this->redirect(['view', 'id' => $service->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', compact('service', 'editForm'));
    }

    public function actionDelete($id)
    {
        $service = Service::getOrFail($id);

        try {
            $this->service->delete($service->id);
            Yii::$app->session->setFlash('success', 'Услуга успешно удалена');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['index']);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionCreate()
    {
        $createForm = new ServiceForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $service = $this->service->create($createForm);
                Yii::$app->session->setFlash('success', 'Услуга добавлена');
                return $this->redirect(['update', 'id' => $service->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', compact( 'createForm'));
    }

    public function actionUpload($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $service = Service::getOrFail($id);
        $imageForm = new ServiceImagesForm();

        if ($imageForm->validate()) {
            try {
                $this->service->addImage($service->id, $imageForm);
                return [];
            } catch (DomainException $e) {
                return ['error' => $e->getMessage()];
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                return ['error' => 'Техническая ошибка'];
            }
        }

        return ['error' => 'Не удалось'];
    }

    public function actionSortImages($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->sortImages($id, Yii::$app->request->post('oldIndex'),  Yii::$app->request->post('newIndex'));
            return [];
        } catch (DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (RuntimeException $e) {
            Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

    public function actionDeleteImage($id, $photoId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->deleteImage($id, $photoId);
            return [];
        } catch (DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (RuntimeException $e) {
            Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

    public function actionMoveUp($id)
    {
        Service::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Service::getOrFail($id)->moveNext();
    }

    public function actionActivate($id)
    {
        try{
            $this->service->activate($id);
            Yii::$app->session->setFlash('success', 'Услуга активирована');
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeactivate($id)
    {
        try{
            $this->service->deactivate($id);
            Yii::$app->session->setFlash('success', 'Услуга заблокирована');
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}