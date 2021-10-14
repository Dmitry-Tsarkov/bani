<?php

namespace app\modules\product\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\product\presentator\ProductPresentator;

class ProductController extends ApiController
{
    private $productPresentator;

    public function __construct($id, $module, ProductPresentator $productPresentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->productPresentator = $productPresentator;
    }

    /**
     * @OA\Get(
     *     path="/api/products/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="podkategoriya-proekty-ban-tovar-0"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionProducts($alias)
    {
        return $this->productPresentator->getProducts($alias);
    }
}