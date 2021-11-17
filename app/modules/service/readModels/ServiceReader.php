<?php

namespace app\modules\service\readModels;

use app\modules\service\models\Service;
use yii\web\NotFoundHttpException;

class ServiceReader
{
    public function getByAlias($alias): Service
    {
        $service = Service::find()
            ->andWhere(['alias' => $alias])
            ->one();

        if (!$service) {
            throw new NotFoundHttpException('Товар не найдет');
        }

        return $service;
    }
}