<?php

namespace app\modules\product\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\order\presentators\OrderPresentator;
use app\modules\product\presentator\ProductPresentator;

class ProductController extends ApiController
{
    private $productPresentator;
    private $orderPresentator;

    public function __construct(
        $id,
        $module,
        ProductPresentator $productPresentator,
        OrderPresentator $orderPresentator,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->productPresentator = $productPresentator;
        $this->orderPresentator = $orderPresentator;
    }

    /**
     * @OA\Get(
     *     path="/api/products/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="podkategoriya-proekty-ban-0"
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

    /**
     * @OA\Get(
     *     path="/api/product/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="tovar-podkategorii-3-1"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionProduct($alias)
    {
        return $this->productPresentator->getProduct($alias);
    }

    /**
     * @OA\Get(
     *     path="/api/product-order/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="tovar-podkategorii-3-1"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionProductOrder($alias)
    {
        return $this->orderPresentator->getProductOrder($alias);
    }
}