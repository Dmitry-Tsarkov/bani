<?php

namespace app\modules\service\repositories;

use app\modules\service\models\Service;
use DomainException;
use RuntimeException;

class ServiceRepository
{
    public function save(Service $service)
    {
        if (!$service->save()) {
            throw new RuntimeException('Service saving error');
        }
    }

    public function getById($id): Service
    {
        if (!$service = Service::find()->andWhere(['id' => $id])->one()) {
            throw new DomainException('Service not found');
        }

        return $service;
    }

    public function delete(Service $service): void
    {
        if(!$service->delete()) {
            throw new DomainException('Service delete error');
        }
    }

    public function hasByAlias($alias): bool
    {
        return (bool)Service::find()
            ->andWhere(['alias' => $alias])
            ->limit(1)
            ->count('id');
    }

    public function hasByAliasExceptSelf($id, $alias): bool
    {
        return (bool)Service::find()
            ->andWhere(['alias' => $alias])
            ->andWhere(['not', ['id' => $id]])
            ->limit(1)
            ->count('id');
    }
}