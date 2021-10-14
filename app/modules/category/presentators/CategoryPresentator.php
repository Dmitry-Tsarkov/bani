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

    public function getProjects($alias)
    {
        $category = $this->categoryReader->getCategory($alias);
        $dataProvider = $this->categoryReader->getProjects($category);

        return [
            'projects' => array_map(function (Category $project) {
                return [
                    'id' => $project->id,
                    'alias' => $project->alias,
                    'title' => $project->title,
                    'description' => $project->description,
                    'minPrice' => 'от ' . CategoryHelper::getProductMinPrice($project)
                ];
            }, $dataProvider->getModels()),
            'pagination' => $dataProvider->pagination
        ];
    }
}