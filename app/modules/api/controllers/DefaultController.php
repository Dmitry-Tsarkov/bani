<?php

namespace app\modules\api\controllers;

use app\modules\api\presentators\MainPresentator;
use function OpenApi\scan;

class DefaultController extends ApiController
{
    private $presentator;

    public function __construct($id, $module, MainPresentator $presentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->presentator = $presentator;
    }

    /**
     * @OA\Get(
     *     path="/api/index",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionIndex()
    {
        return $this->presentator->getIndex();
    }

    /**
     * @OA\Get(
     *     path="/api/layout",
     *     tags={"Layouts"},
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function actionLayout()
    {
        return $this->presentator->getLayout();
    }


    public function actionSwagger()
    {
        $openapi = scan(\Yii::getAlias('@app/modules'));
        header('Content-Type: application/json');
        echo $openapi->toJson();
        exit();
    }

    /**
     * @OA\Get(
     *     path="/api/home",
     *     tags={"Pages"},
     *     @OA\Response(
     *      response="200",
     *      description="An example resource",
     *     )
     * )
     */
    public function actionHome()
    {
        return $this->presentator->getHome();
    }
}