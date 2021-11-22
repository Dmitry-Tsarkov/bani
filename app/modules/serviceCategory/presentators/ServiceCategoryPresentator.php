<?php

namespace app\modules\serviceCategory\presentators;

use app\modules\serviceCategory\helpers\ServiceCategoryHelper;
use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\serviceCategory\readModels\ServiceCategoryReader;
use yii\helpers\Url;

class ServiceCategoryPresentator
{
    private $serviceCategoryReader;

    public function __construct(ServiceCategoryReader $categoryReader)
    {
        $this->serviceCategoryReader = $categoryReader;
    }

    public function getServiceCategories()
    {
        $serviceCategories = $this->serviceCategoryReader->getServiceCategories();
        return [
            'serviceCategories' => array_map(function (ServiceCategory $category) {
                return [
                    'id' => $category->id,
                    'alias' => $category->alias,
                    'title' => $category->title,
                    'description' => $category->description,
                    'image' => Url::to($category->getImageFileUrl('image'), true),
                ];
            }, $serviceCategories)
        ];
    }

    public function getServiceSubcategories($alias)
    {
        $category = $this->serviceCategoryReader->getCategory($alias);
        $dataProvider = $this->serviceCategoryReader->getSubcategories($category);

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