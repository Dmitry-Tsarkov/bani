<?php

namespace app\modules\category\presentators;

use app\modules\category\models\Category;
use app\modules\category\readModels\CategoryReader;
use yii\helpers\Url;

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
        $category = Category::find()->andWhere(['alias' => $alias])->one();
        $dataProvider = $this->categoryReader->getProjects($category);

        return [
            'projects' => array_map(function (Category $project) {
                return [
                    'id' => $project->id,
                    'alias' => $project->alias,
                    'title' => $project->title,
                    'description' => $project->description
                ];
            }, $dataProvider->getModels()),
            'pagination' => $dataProvider->pagination
        ];
    }

//    public function getAllSubcategories()
//    {
//        $allSubcategories = $this->categoryReader->getAllSubcategories();
//
//        return array_map(function (Category $category) {
//            return [
//                'icon' => Url::to($category->getImageSrc(), true),
//                'title' => $category->title,
//                'alias' => $category->alias,
//                'design' => $category->design,
//            ];
//        }, $allSubcategories);
//    }
//
//    private function getSubcategories(?Category $category)
//    {
//        $subCategories = $this->categoryReader->getSubcategories($category);
//
//        return array_map(function (Category $category) {
//            $services = $this->serviceReader->inCategory($category);
//            return [
//                'title' => $category->title,
//                'alias' => $category->alias,
//                'icon' => Url::to($category->getImageSrc(), true),
//                'services' => array_map(function (Service $subcategory) {
//                    return [
//                        "title" => $subcategory->title,
//                        "alias" => $subcategory->alias,
//                    ];
//                }, $services),
//            ];
//        }, $subCategories);
//    }
//
//    private function getServices(Category $category)
//    {
//        $services = $this->serviceReader->inCategory($category);
//
//        return array_map(function (Service $service) {
//            return [
//                'icon' => $service->getIconSrc(),
//                'image' => $service->getThumbSrc(),
//                'title' => $service->title,
//                'alias' => $service->alias,
//            ];
//        }, $services);
//    }
//
//    public function getCategory($alias)
//    {
//        $category = Category::findOneOrException(['alias' => $alias]);
//
//        $data = [
//            'meta' => $category->getMetaTags(),
//            'breadcrumbs' => $this->categoryReader->getBreadcrumbsForCategory($category),
//        ];
//
//        if (!$category->isLeaf()) {
//            $data['subcategories'] = $this->getSubcategories($category);
//        } else {
//            $data['services'] = $this->getServices($category);
//        }
//
//        return $data;
//    }
}