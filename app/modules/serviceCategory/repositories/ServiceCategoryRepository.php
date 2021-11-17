<?php

namespace app\modules\serviceCategory\repositories;

use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\service\models\Service;
use DomainException;
use RuntimeException;

class ServiceCategoryRepository
{
    public function save(ServiceCategory $category): void
    {
        $dirty = $category->getDirtyAttributes();

        if (!empty($dirty['parent_id'])) {
            if (!$category->appendTo(ServiceCategory::findOne($category->parent_id))) {
                throw new RuntimeException('ServiceCategory saving error');
            }
            return;
        }

        if (!$category->save()) {
            throw new RuntimeException('ServiceCategory saving error');
        }
    }

    public function delete(ServiceCategory $category): void
    {
        if (!$category->delete()) {
            throw new RuntimeException('ServiceCategory deleting error');
        }
    }

    public function getById($id): ServiceCategory
    {
        $category = ServiceCategory::find()->andWhere(['id' => $id])->limit(1)->one();

        if ($category === null) {
            throw new DomainException('Категория не найдена');
        }

        return $category;
    }

    public function getByAlias($alias)
    {
        return ServiceCategory::find()
            ->andWhere(['alias' => $alias])
            ->one();
    }

    public function hasServices(ServiceCategory $category): bool
    {
        $categoryIds = $category->children()->select('id')->column();
        $categoryIds[] = $category->id;

        return (bool)Service::find()
            ->andWhere(['category_id' => $categoryIds])
            ->count('id');
    }
}