<?php

namespace app\modules\product\repositories;

use app\modules\product\models\Product;
use DomainException;
use RuntimeException;
use yii\web\NotFoundHttpException;

class ProductRepository
{
    public function save(Product $service)
    {
        if (!$service->save()) {
            throw new RuntimeException('Product saving error');
        }
    }

    public function getById($id): Product
    {
        if (!$service = Product::find()->andWhere(['id' => $id])->one()) {
            throw new DomainException('Product not found');
        }

        return $service;
    }

    public function delete(Product $service): void
    {
        if(!$service->delete()) {
            throw new DomainException('Product delete error');
        }
    }

    public function hasByAlias($alias): bool
    {
        return (bool)Product::find()
            ->andWhere(['alias' => $alias])
            ->limit(1)
            ->count('id');
    }

    public function hasByAliasExceptSelf($id, $alias): bool
    {
        return (bool)Product::find()
            ->andWhere(['alias' => $alias])
            ->andWhere(['not', ['id' => $id]])
            ->limit(1)
            ->count('id');
    }

    public function getByAlias($alias)
    {
        $product = Product::find()
            ->andWhere(['alias' => $alias])
            ->one();

        if (!$product) {
            throw new NotFoundHttpException('Продукт не найден');
        }

        return $product;
    }
}