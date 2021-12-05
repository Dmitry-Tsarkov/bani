<?php

namespace app\modules\calculator\UI\api\controllers;

use app\modules\api\controllers\ApiController;
use app\modules\calculator\presentators\CalculatorPresentator;

class CalculatorController extends ApiController
{
    private $presentator;

    public function __construct($id, $module, CalculatorPresentator $presentator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->presentator = $presentator;
    }

    public function actionCalculators()
    {
        return $this->presentator->getCalculators();
    }

    /**
     * @OA\Get(
     *     path="/api/calculator/{id}",
     *     @OA\Parameter(name="id",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *          type="integer",
     *          default="1"
     *      )
     *     ),
     *     tags={"Pages"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="An example resource")
     * )
     */
    public function actionCalculator($id)
    {
        return $this->presentator->getCalculator($id);
    }
}