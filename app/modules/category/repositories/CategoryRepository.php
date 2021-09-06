<?php

namespace app\modules\category\repositories;

use app\modules\category\models\Category;
use app\modules\service\models\Service;
use DomainException;
use RuntimeException;

class CategoryRepository
{
    public function save(Category $category): void
    {
        $dirty = $category->getDirtyAttributes();

        if (!empty($dirty['parent_id'])) {
            if(!$category->appendTo(Category::findOne($category->parent_id))) {
                throw new RuntimeException('Category saving error');
            }
            return;
        }

        if(!$category->save()) {
            throw new RuntimeException('Category saving error');
        }
    }

    public function delete(Category $category): void
    {
        if (!$category->delete()) {
            throw new RuntimeException('Category deleting error');
        }
    }

    public function getById($id): Category
    {
        $category = Category::find()->andWhere(['id' => $id])->limit(1)->one();

        if ($category === null) {
            throw new DomainException('Категория не найдена');
        }

        return $category;
    }


//    public function hasProducts(Category $category): bool
//    {
//        $categoryIds = $category->children()->select('id')->column();
//        $categoryIds[] = $category->id;
//
//        return (bool)Service::find()
//            ->andWhere(['category_id' => $categoryIds])
//            ->count('id');
//    }
    public function getByAlias($alias)
    {
        return Category::find()
            ->andWhere(['alias' => $alias])
            ->one();
    }

}