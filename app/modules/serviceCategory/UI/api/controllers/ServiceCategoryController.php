<?php

namespace app\modules\serviceCategory\category\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\serviceCategory\presentators\ServiceCategoryPresentator;

class ServiceCategoryController extends ApiController
{
    private $categoryPresentator;

    public function __construct($id, $module, ServiceCategoryPresentator $categoryPresentator, $config = [])
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
    public function actionCategories()
    {
        return $this->categoryPresentator->getAllCategories();
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
    public function actionProjects($alias)
    {
        return $this->categoryPresentator->getSubcategories($alias);
    }
}