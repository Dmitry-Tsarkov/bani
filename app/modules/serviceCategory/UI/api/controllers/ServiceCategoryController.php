<?php

namespace app\modules\serviceCategory\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\serviceCategory\presentators\ServiceCategoryPresentator;

class ServiceCategoryController extends ApiController
{
    private $categoryPresentator;

    public function __construct($id, $module, ServiceCategoryPresentator $serviceCategoryPresentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryPresentator = $serviceCategoryPresentator;
    }

    /**
     * @OA\Get(
     *     path="/api/services-catalog",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionServicesCatalog()
    {
        return $this->categoryPresentator->getServiceCategories();
    }

    /**
     * @OA\Get(
     *     path="/api/service-catalog/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="fundament"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionServiceCatalog($alias)
    {
        return $this->categoryPresentator->getServiceSubcategories($alias);
    }
}