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
     *     path="/api/catalog",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionCatalog()
    {
        return $this->categoryPresentator->getCatalog();
    }

    /**
     * @OA\Get(
     *     path="/api/catalog/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="proekty-ban"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionCategories($alias)
    {
        return $this->categoryPresentator->getProductCategories($alias);
    }
}