<?php

namespace app\modules\service\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\order\presentators\OrderPresentator;
use app\modules\service\presentator\ServicePresentator;

class ServiceController extends ApiController
{
    private $servicePresentator;
    private $orderPresentator;

    public function __construct(
        $id,
        $module,
        ServicePresentator $servicePresentator,
        OrderPresentator $orderPresentator,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->servicePresentator = $servicePresentator;
        $this->orderPresentator = $orderPresentator;
    }

    /**
     * @OA\Get(
     *     path="/api/services/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="podkategoriya-fundament-0"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionServices($alias)
    {
        return $this->servicePresentator->getServices($alias);
    }

    /**
     * @OA\Get(
     *     path="/api/service/{alias}",
     *     @OA\Parameter(name="alias",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="string",
     *          default="usluga-podkategorii-3-1"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionService($alias)
    {
        return $this->servicePresentator->getService($alias);
    }

    /**
     * @OA\Get(
     *     path="/api/service-order/{alias}",
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
    public function actionServiceOrder($alias)
    {
        return $this->orderPresentator->getServiceOrder($alias);
    }
}