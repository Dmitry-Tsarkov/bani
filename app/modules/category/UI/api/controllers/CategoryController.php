<?php

namespace app\modules\category\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\category\presentators\CategoryPresentator;

class CategoryController extends ApiController
{
    private $categoryPresentator;

    public function __construct($id, $module, CategoryPresentator $categoryPresentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryPresentator = $categoryPresentator;
    }

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionCategories()
    {
        return $this->categoryPresentator->getAllCategories();
    }

    public function actionProjects($alias)
    {
        return $this->categoryPresentator->getProjects($alias);
    }


}