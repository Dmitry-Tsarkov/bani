<?php

namespace app\modules\service\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\service\presentator\ServicePresentator;

class ServiceController extends ApiController
{
    private $servicePresentator;

    public function __construct($id, $module, ServicePresentator $servicePresentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->servicePresentator = $servicePresentator;
    }

    /**
     * @OA\Get(
     *     path="/api/services-catalog/{alias}",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionServicesCatalog()
    {
        return $this->servicePresentator->getServicesCatalog();
    }

    /**
     * @OA\Get(
     *     path="/api/services/{alias}",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionServices($alias)
    {
        return $this->servicePresentator->getServices($alias);
    }

    /**
     * @OA\Get(
     *     path="/api/service/{alias}",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionService($alias)
    {
        return $this->servicePresentator->getService($alias);
    }
}