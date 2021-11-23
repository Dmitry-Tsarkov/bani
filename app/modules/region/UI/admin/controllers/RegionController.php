<?php

namespace app\modules\region\UI\admin\controllers;

use app\modules\admin\components\BalletController;
use app\modules\region\models\Region;
use app\modules\region\searchModels\RegionSearch;
use DomainException;
use app\modules\region\forms\RegionForm;
use app\modules\region\services\RegionService;
use Yii;

class RegionController extends BalletController
{
    private $service;

    public function __construct($id, $module, RegionService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $searchModel = new RegionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionCreate()
    {
        $regionForm = new RegionForm();

        if ($regionForm->load(Yii::$app->request->post()) && $regionForm->validate()) {
            try {
                $product = $this->service->create($regionForm);
                Yii::$app->session->setFlash('success', 'Регион добавлен');
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', compact('regionForm'));
    }

    public function actionDelete($id)
    {
        $region = Region::getOrFail($id);
        if ($region->delete()) {
            Yii::$app->session->setFlash('success', 'Регион удален');
            return $this->redirect(['index']);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}