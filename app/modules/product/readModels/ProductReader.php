<?php

namespace app\modules\product\readModels;

use app\modules\product\models\Product;
use yii\web\NotFoundHttpException;

class ProductReader
{
    public function getByAlias($alias): Product
    {
        $product = Product::find()
            ->andWhere(['alias' => $alias])
            ->one();

        if (!$product) {
            throw new NotFoundHttpException('Товар не найдет');
        }

        return $product;
    }
}