<?php

namespace app\modules\category\presentators;

use app\modules\category\helpers\CategoryHelper;
use app\modules\category\models\Category;
use app\modules\category\readModels\CategoryReader;
use app\modules\setting\components\Settings;
use yii\helpers\Url;

class CategoryPresentator
{
    private $productCategoryReader;

    public function __construct(CategoryReader $categoryReader)
    {
        $this->productCategoryReader = $categoryReader;
    }

    public function getCatalog()
    {
        $productCategories = $this->productCategoryReader->getProductCategories();

        return [
            'description' => Settings::getValue('catalog_text'),
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
            'meta' => $category->getMetaTags(),
            'title' => $category->title,
            'description' => $category->description,
            'bottom_description' => $category->bottom_description,
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