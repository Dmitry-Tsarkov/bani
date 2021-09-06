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

    public function actionCategories()
    {
        return $this->categoryPresentator->getAllCategories();
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="stomatologicheskie-uslugi"
     *      )
     *     ),
     *     tags={"Categories"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionCategory($alias)
    {
        return $this->categoryPresentator->getCategory($alias);
    }

}