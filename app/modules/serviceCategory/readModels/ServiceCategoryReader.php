<?php

namespace app\modules\serviceCategory\readModels;

use app\modules\serviceCategory\models\ServiceCategory;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ServiceCategoryReader
{
    public function getCategories(): array
    {
        return ServiceCategory::find()
            ->andWhere(['depth' => 1])
            ->orderBy(['lft' => SORT_ASC])
            ->all();
    }

    public function geSubcategories(ServiceCategory $category)
    {
        $query = $category->children(1)
            ->andWhere(['>', 'depth', 1])
            ->orderBy(['lft' => SORT_ASC]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 10],
        ]);
    }

    public function getCategory($alias)
    {
        return ServiceCategory::find()
            ->andWhere(['alias' => $alias])
            ->one();
    }

    public function getAllSubcategories()
    {
        return ServiceCategory::find()
            ->andWhere(['>', 'depth', 1])
            ->all();
    }

    public function getSubcategory($alias)
    {
        return ServiceCategory::find()
            ->andWhere(['alias' => $alias])
            ->andWhere(['>', 'depth', 1])
            ->one();
    }

    public function getSubcategories(ServiceCategory $parent): array
    {
        return $parent->children(1)
            ->andWhere(['>', 'depth', 1])
            ->orderBy(['lft' => SORT_ASC])
            ->all();
    }

    public function getByAlias($alias): ServiceCategory
    {
        $category = ServiceCategory::find()
            ->andWhere(['alias' => $alias])
            ->one();

        if (!$category) {
            throw new NotFoundHttpException('Услуга не найдена');
        }

        return $category;
    }

//    public function getBreadcrumbsForService(Service $service)
//    {
//        $result = [];
//        $rows = $service->category->getParent()
//            ->andWhere(['>', 'depth', 0])
//            ->select(['title', 'alias', 'id'])
//            ->orderBy('lft')
//            ->asArray()
//            ->all();
//
//        foreach ($rows as $row) {
//            $result[] = [
//                'id' => (int)$row['id'],
//                'title' => $row['title'],
//                'alias' => $row['alias'],
//            ];
//        }
//
//        $result[] = [
//            'id' => $service->category->id,
//            'title' => $service->category->title,
//            'alias' => $service->category->alias,
//        ];
//
//        return $result;
//    }

    public function getBreadcrumbsForCategory(ServiceCategory $category)
    {
        $result = [];
        $rows = $category->getParent()
            ->andWhere(['>', 'depth', 0])
            ->select(['title', 'alias', 'id'])
            ->orderBy('lft')
            ->asArray()
            ->all();

        foreach ($rows as $row) {
            $result[] = [
                'id' => (int)$row['id'],
                'title' => $row['title'],
                'alias' => $row['alias'],
            ];
        }

        return $result;
    }

    public function getServiceCategories(): array
    {
        return ServiceCategory::find()
            ->andWhere(['depth' => 1])
            ->orderBy(['lft' => SORT_ASC])
            ->all();
    }
}