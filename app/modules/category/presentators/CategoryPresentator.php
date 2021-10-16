<?php

namespace app\modules\category\presentators;

use app\modules\category\helpers\CategoryHelper;
use app\modules\category\models\Category;
use app\modules\category\readModels\CategoryReader;
use yii\helpers\Url;
use yii\helpers\VarDumper;

class CategoryPresentator
{
    private $categoryReader;

    public function __construct(CategoryReader $categoryReader)
    {
        $this->categoryReader = $categoryReader;
    }

    public function getAllCategories()
    {
        $categories = $this->categoryReader->getCategories();
        return [
            'categories' => array_map(function (Category $category) {
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