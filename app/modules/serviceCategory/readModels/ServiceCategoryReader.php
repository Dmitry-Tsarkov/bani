<?php

namespace app\modules\serviceCategory\readModels;

use app\modules\serviceCategory\models\ServiceCategory;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ServiceCategoryReader
{
    public function getServiceCategories(): array
    {
        return ServiceCategory::find()
            ->andWhere(['depth' => 1])
            ->orderBy(['lft' => SORT_ASC])
            ->all();
    }

    public function getCategory($alias)
    {
        return ServiceCategory::find()
            ->andWhere(['alias' => $alias])
            ->one();
    }

    public function getSubcategories(ServiceCategory $category)
    {
        $query = $category->children(1)
            ->andWhere(['>', 'depth', 1])
            ->orderBy(['lft' => SORT_ASC]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 10],
        ]);
    }

    public function getByAlias($alias): ServiceCategory
    {
        $serviceCategory = ServiceCategory::find()
            ->andWhere(['alias' => $alias])
            ->one();

        if (!$serviceCategory) {
            throw new NotFoundHttpException('Услуга не найдена');
        }

        return $serviceCategory;
    }
}