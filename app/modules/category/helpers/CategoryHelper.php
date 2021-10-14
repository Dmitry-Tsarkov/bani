<?php

namespace app\modules\category\helpers;

use app\modules\category\models\Category;
use yii\helpers\VarDumper;

class CategoryHelper
{
    public static function getProductMinPrice(Category $project): int
    {
        $prices = [];
        foreach ($project->products as $product) {
            $prices[] = $product->price;
        }

        return min($prices);
    }
}