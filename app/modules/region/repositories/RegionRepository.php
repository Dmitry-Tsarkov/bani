<?php

namespace app\modules\region\repositories;

use app\modules\region\models\Region;
use DomainException;
use RuntimeException;
use yii\web\NotFoundHttpException;

class RegionRepository
{
    public function save(Region $service)
    {
        if (!$service->save()) {
            throw new RuntimeException('Region saving error');
        }
    }

    public function getById($id): Region
    {
        if (!$service = Region::find()->andWhere(['id' => $id])->one()) {
            throw new DomainException('Region not found');
        }

        return $service;
    }

    public function delete(Region $service): void
    {
        if(!$service->delete()) {
            throw new DomainException('Region delete error');
        }
    }

    public function hasByCityAlias($title_alias): bool
    {
        return (bool)Region::find()
            ->andWhere(['title_alias' => $title_alias])
            ->limit(1)
            ->count('id');
    }


    public function hasByDistrictAlias($district_alias): bool
    {
        return (bool)Region::find()
            ->andWhere(['district_alias' => $district_alias])
            ->limit(1)
            ->count('id');
    }

    public function getRegions()
    {
        return Region::find()
            ->select(['title', 'title_alias', 'district', 'district_alias' ])
            ->all();
    }

    public function getRegionByAlias($alias)
    {
        $region = Region::find()
            ->andWhere(['title_alias' => $alias])
            ->one();

        if (!$region) {
            throw new NotFoundHttpException('Регион не найден');
        }

        return $region;
    }
}