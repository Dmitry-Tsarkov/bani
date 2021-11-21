<?php

namespace app\modules\category\presentators;

use app\modules\category\helpers\CategoryHelper;
use app\modules\category\models\Category;
use app\modules\category\readModels\CategoryReader;
use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\serviceCategory\readModels\ServiceCategoryReader;
use yii\helpers\Url;
use yii\helpers\VarDumper;

class CategoryPresentator
{
    private $productCategoryReader;
    private $serviceCategoryReader;

    public function __construct(CategoryReader $categoryReader, ServiceCategoryReader $serviceCategoryReader)
    {
        $this->productCategoryReader = $categoryReader;
        $this->serviceCategoryReader = $serviceCategoryReader;
    }

    public function getCatalog()
    {
        $productCategories = $this->productCategoryReader->getProductCategories();

        return [
            'catalog' => array_map(function (Category $category) {
                return [
                    'id' => $category->id,
                    'alias' => $category->alias,
                    'title' => $category->title,
                    'description' => $category->description,
                    'image' => Url::to($category->getImageFileUrl('image'), true),
                ];
            }, $productCategories),
        ];
    }

    public function getProductCategories($alias)
    {
        $category = $this->productCategoryReader->getCategory($alias);
        $dataProvider = $this->productCategoryReader->geSubcategories($category);

        return [
            'subcategories' => array_map(function (Category $subcategory) {
                return [
                    'id' => $subcategory->id,
                    'alias' => $subcategory->alias,
                    'title' => $subcategory->title,
                    'description' => $subcategory->description,
                    'minPrice' => 'от ' . CategoryHelper::getProductMinPrice($subcategory),
                    'image' => Url::to($subcategory->getImageFileUrl('image'), true),
                ];
            }, $dataProvider->getModels()),
            'pagination' => $dataProvider->pagination
        ];
    }
}