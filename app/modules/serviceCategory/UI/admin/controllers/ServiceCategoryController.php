<?php

namespace app\modules\serviceCategory\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\serviceCategory\forms\ServiceCategoryForm;
use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\serviceCategory\presentators\ServiceCategoryPresentator;
use app\modules\serviceCategory\searchModels\ServiceCategorySearch;
use app\modules\serviceCategory\services\ServiceCategoryService;
use DomainException;
use Exception;
use RuntimeException;
use Yii;
use yii\web\Response;

class ServiceCategoryController extends BalletController
{
    private $service;
    private $presentator;

    public function __construct($id, $module, ServiceCategoryService $service, ServiceCategoryPresentator $presentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->presentator = $presentator;
    }

    public function actionIndex()
    {
        $searchModel = new ServiceCategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $createForm = new ServiceCategoryForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $category = $this->service->create($createForm);
                Yii::$app->session->setFlash('success', 'Категория добавлена');
                return $this->redirect(['update', 'id' => $category->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', compact('createForm'));
    }

    public function actionUpdate($id)
    {
        $category = ServiceCategory::getOrFail($id);
        $editForm = new ServiceCategoryForm($category);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                $this->service->edit($category->id, $editForm);
                Yii::$app->session->setFlash('success', 'Категория обновлена');
                return $this->redirect(['update', 'id' => $category->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }
        return $this->render('update', compact('editForm', 'category'));
    }

    public function actionDelete($id)
    {
        $category = ServiceCategory::getOrFail($id);

        try {
            $this->service->delete($category->id);
            Yii::$app->session->setFlash('success', 'Категория успешно удалена');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(\Yii::$app->request->referrer);
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

    public function actionMoveUp($id)
    {
        $category = ServiceCategory::getOrFail($id);
        if ($prev = $category->prev()->one()) {
            $category->insertBefore($prev);
        }
    }

    public function actionMoveDown($id)
    {
        $category = ServiceCategory::getOrFail($id);
        if ($prev = $category->next()->one()) {
            $category->insertAfter($prev);
        }
    }
}