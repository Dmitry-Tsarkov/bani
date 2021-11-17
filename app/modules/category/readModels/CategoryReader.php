<?php

namespace app\modules\category\readModels;

use app\modules\category\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CategoryReader
{
    public function getProductCategories(): array
    {
        return Category::find()
            ->andWhere(['depth' => 1])
            ->orderBy(['lft' => SORT_ASC])
            ->all();
    }

    public function geSubcategories(Category $category)
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
        return Category::find()
            ->andWhere(['alias' => $alias])
            ->one();
    }

    public function getAllSubcategories()
    {
        return Category::find()
            ->andWhere(['>', 'depth', 1])
            ->all();
    }

    public function getSubcategory($alias)
    {
        return Category::find()
            ->andWhere(['alias' => $alias])
            ->andWhere(['>', 'depth', 1])
            ->one();
    }

    public function getSubcategories(Category $parent): array
    {
        return $parent->children(1)
            ->andWhere(['>', 'depth', 1])
            ->orderBy(['lft' => SORT_ASC])
            ->all();
    }

    public function getByAlias($alias): Category
    {
        $category = Category::find()
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

    public function getBreadcrumbsForCategory(Category $category)
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
//    public function getInCategory(Category $category)
//    {
//        return $category->getServices()
//            ->andWhere(['status' => 1])
//            ->all();
//    }
}