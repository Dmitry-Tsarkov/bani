<?php

namespace app\modules\region\repositories;

use app\modules\region\models\Region;
use DomainException;
use RuntimeException;

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

    public function hasByCityAlias($city_alias): bool
    {
        return (bool)Region::find()
            ->andWhere(['city_alias' => $city_alias])
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
}