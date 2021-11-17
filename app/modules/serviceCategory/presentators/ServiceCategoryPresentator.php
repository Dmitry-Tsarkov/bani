<?php

namespace app\modules\serviceCategory\presentators;

use app\modules\serviceCategory\helpers\ServiceCategoryHelper;
use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\serviceCategory\readModels\ServiceCategoryReader;
use yii\helpers\Url;

class ServiceCategoryPresentator
{
    private $categoryReader;

    public function __construct(ServiceCategoryReader $categoryReader)
    {
        $this->categoryReader = $categoryReader;
    }

    public function getAllCategories()
    {
        $categories = $this->categoryReader->getCategories();
        return [
            'categories' => array_map(function (ServiceCategory $category) {
                return [
                    'id' => $category->id,
                    'alias' => $category->alias,
                    'title' => $category->title,
                    'description' => $category->description,
                    'image' => Url::to($category->getImageFileUrl('image'), true),
                ];
            }, $categories)
        ];
    }

    public function getSubcategories($alias)
    {
        $category = $this->categoryReader->getCategory($alias);
        $dataProvider = $this->categoryReader->geSubcategories($category);

        return [
            'subcategories' => array_map(function (ServiceCategory $subcategory) {
                return [
                    'id' => $subcategory->id,
                    'alias' => $subcategory->alias,
                    'title' => $subcategory->title,
                    'description' => $subcategory->description,
                    'minPrice' => 'от ' . ServiceCategoryHelper::getServiceMinPrice($subcategory),
                    'image' => Url::to($subcategory->getImageFileUrl('image'), true),
                ];
            }, $dataProvider->getModels()),
            'pagination' => $dataProvider->pagination
        ];
    }
}