<?php

namespace app\modules\category\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\category\forms\CategoryForm;
use app\modules\category\models\Category;
use app\modules\category\presentators\CategoryPresentator;
use app\modules\category\searchModels\CategorySearch;
use app\modules\category\services\CategoryService;
use DomainException;
use Exception;
use RuntimeException;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Response;

class CategoryController extends BalletController
{
    private $service;
    private $presentator;

    public function __construct($id, $module, CategoryService $service, CategoryPresentator $presentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->presentator = $presentator;
    }

    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $createForm = new CategoryForm();

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
        $category = Category::getOrFail($id);
        $editForm = new CategoryForm($category);

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
        $category = Category::getOrFail($id);

        try {
            $this->service->delete($category->id);
            Yii::$app->session->setFlash('success', 'Категория успешно удалена');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDeleteIcon($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->deleteIcon($id);
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
        $category = Category::getOrFail($id);
        if ($prev = $category->prev()->one()) {
            $category->insertBefore($prev);
        }
    }

    public function actionMoveDown($id)
    {
        $category = Category::getOrFail($id);
        if ($prev = $category->next()->one()) {
            $category->insertAfter($prev);
        }
    }
}