<?php

namespace app\modules\review\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\review\forms\ReviewManageForm;
use app\modules\review\models\Review;
use app\modules\review\searchModels\ReviewSearch;
use app\modules\review\services\ReviewManageService;
use DomainException;
use Exception;
use RuntimeException;
use Yii;
use yii\filters\VerbFilter;

class ReviewController extends BalletController
{
    private $service;

    public function __construct($id, $module, ReviewManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors()
    {
        return [
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'activate' => ['POST'],
                    'deactivate' => ['POST'],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionCreate()
    {
        $createForm = new ReviewManageForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try{
                $category = $this->service->create($createForm);
                Yii::$app->session->setFlash('success', 'Отзыв добавлен');
                return $this->redirect(['update', 'id' => $category->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', compact( 'createForm'));
    }

    public function actionUpdate($id)
    {
        $review = Review::getOrFail($id);
        $editForm = new ReviewManageForm($review);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                $this->service->edit($review->id, $editForm);
                Yii::$app->session->setFlash('success', 'Отзыв обновлен');
                return $this->redirect(['update', 'id' => $review->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', compact('editForm', 'review'));
    }

    public function actionActivate($id)
    {
        try{
            $this->service->activate($id);
            Yii::$app->session->setFlash('success', 'Отзыв активирован');
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeactivate($id)
    {
        try{
            $this->service->deactivate($id);
            Yii::$app->session->setFlash('success', 'Отзыв заблокирован');
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
        $review = Review::getOrFail($id);

        try {
            $this->service->delete($review->id);
            Yii::$app->session->setFlash('success', 'Отзыв успешно удален');
        } catch (DomainException|RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['index']);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionShow($id)
    {
        $portfolio = Review::getOrFail($id);

        try {
            $this->service->show($portfolio->id);
            Yii::$app->session->setFlash('success', 'Показывается на главной странице');
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (RuntimeException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionHide($id)
    {
        $product = Review::getOrFail($id);

        try {
            $this->service->hide($product->id);
            Yii::$app->session->setFlash('success', 'Не показывается на главной странице');
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (RuntimeException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

}