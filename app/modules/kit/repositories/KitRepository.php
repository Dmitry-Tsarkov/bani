<?php

namespace app\modules\kit\repositories;

use app\modules\kit\models\Kit;
use DomainException;
use RuntimeException;

class KitRepository
{
    public function save(Kit $service)
    {
        if (!$service->save()) {
            throw new RuntimeException('Kit saving error');
        }
    }

    public function getById($id): Kit
    {
        if (!$service = Kit::find()->andWhere(['id' => $id])->one()) {
            throw new DomainException('Kit not found');
        }

        return $service;
    }

    public function delete(Kit $service): void
    {
        if(!$service->delete()) {
            throw new DomainException('Kit delete error');
        }
    }

    public function hasByAlias($alias): bool
    {
        return (bool)Kit::find()
            ->andWhere(['alias' => $alias])
            ->limit(1)
            ->count('id');
    }

    public function hasByAliasExceptSelf($id, $alias): bool
    {
        return (bool)Kit::find()
            ->andWhere(['alias' => $alias])
            ->andWhere(['not', ['id' => $id]])
            ->limit(1)
            ->count('id');
    }

    public function getByAlias($alias)
    {
        return Kit::find()
            ->andWhere(['alias' => $alias])
            ->one();
    }
}