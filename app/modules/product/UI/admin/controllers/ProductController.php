<?php

namespace app\modules\product\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\product\forms\KitEditForm;
use app\modules\product\forms\ImagesForm;
use app\modules\product\forms\ProductForm;
use app\modules\product\models\Product;
use app\modules\product\searchModel\ProductSearch;
use app\modules\product\services\ProductService;
use DomainException;
use Exception;
use RuntimeException;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Response;

class ProductController extends BalletController
{
    private $service;

    public function __construct($id, $module, ProductService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionView($id)
    {
        $product = Product::getOrFail($id);

        return $this->render('view', compact('product'));
    }

    public function actionUpdate($id)
    {
        $product = Product::getOrFail($id);
        $editForm = new ProductForm($product);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                $this->service->edit($product->id, $editForm);
                Yii::$app->session->setFlash('success', 'Товар изменен');
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', compact('product', 'editForm'));
    }

    public function actionDelete($id)
    {
        $product = Product::getOrFail($id);

        try {
            $this->service->delete($product->id);
            Yii::$app->session->setFlash('success', 'Товар успешно удален');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['index']);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionCreate()
    {
        $createForm = new ProductForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $product = $this->service->create($createForm);
                Yii::$app->session->setFlash('success', 'Товар добавлен');
                return $this->redirect(['update', 'id' => $product->id]);
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

        $product = Product::getOrFail($id);
        $imageForm = new ImagesForm();

        if ($imageForm->validate()) {
            try {
                $this->service->addImage($product->id, $imageForm);
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
        Product::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Product::getOrFail($id)->moveNext();
    }

    public function actionActivate($id)
    {
        try{
            $this->service->activate($id);
            Yii::$app->session->setFlash('success', 'Товар активирован');
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeactivate($id)
    {
        try{
            $this->service->deactivate($id);
            Yii::$app->session->setFlash('success', 'Товар заблокирован');
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAddKit($id)
    {
        $product = Product::getOrFail($id);
        $editForm = new KitEditForm($product);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                VarDumper::dump($editForm,10,true);die();
                $this->service->setValue($product->id, $editForm);
                Yii::$app->session->setFlash('success', 'Комплект добавлен');
                return $this->redirect(['product/view', 'id' => $product->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('success', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('success', $e->getMessage());
            }
        }

        return $this->render('add', compact('product', 'editForm'));
    }
}